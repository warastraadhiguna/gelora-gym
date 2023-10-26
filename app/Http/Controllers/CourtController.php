<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $building_id = Request()->input("building_id");
        $data = [
            'title' => "Manajemen Data Lapangan",
            'courts' => Court::where("building_id", $building_id)->get(),
            'buildings' => Building::where("is_active", "=", "1")->get(),
            'content' => "admin/court/index",
            'building_id' => $building_id
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $building_id = Request()->input("building_id");
        if(!$building_id) {
            Alert::error('Error', "Gedung tidak ditemukan");
            return redirect("/admin/court");
        }

        $building = Building::find($building_id);
        if(!$building) {
            Alert::error('Error', "Gedung tidak ditemukan");
            return redirect("/admin/court");
        }

        $data = [
            'title' => "Tambah Data Lapangan",
            'content' => "admin/court/add",
            'building_id' => $building_id
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse/Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'building_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'note' => 'sometimes',
            'price' => 'required',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'is_active' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image_url')) {
            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] = null;
        }

        Court::create($data);
        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/court?building_id=" . $data['building_id']);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $court = Court::find($id);
        $data = [
            'title' => "Ubah Data Lapangan",
            'court' => $court,
            'building_id' => $court->building_id,
            'content' => "admin/court/add"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    * @return \Illuminate\Http\RedirectResponse/Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $court = Court::find($id);
        $data = $request->validate([
            'building_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'note' => 'sometimes',
            'price' => 'required',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'is_active' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;


        if($request->hasFile('image_url')) {
            if($court->image_url != null) {
                Storage::delete($court->image_url);
            }

            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] =  $court->image_url;
        }

        $court->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/court?building_id=" . $data['building_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    * @return \Illuminate\Http\RedirectResponse/Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $court = Court::find($id);

            if($court->image_url) {
                Storage::delete($court->image_url);
            }

            $court->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/court");
        }
    }
}
