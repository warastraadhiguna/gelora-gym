<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        try {

            $data = [
                'title' => "Manajemen Data Gedung",
                'buildings' => Building::get(),
                'content' => "admin/building/index"
            ];

            return view("admin.layouts.wrapper", $data);

        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'title' => "Tambah Data Gedung",
            'content' => "admin/building/add"
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
            'type_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'note' => 'sometimes',
            'facilities' => 'required',
            'operational_times' => 'required',
            'address' => 'required',
            'google_location_url' => 'sometimes',
            'phone' => 'required',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'star' => 'required|numeric|min:2|max:5',
            'is_bookable' => 'required',
            'is_active' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image_url')) {
            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] = null;
        }

        Building::create($data);
        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/building");
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
        $data = [
            'title' => "Ubah Data Gedung",
            'building' => Building::find($id),
            'content' => "admin/building/add"
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
        $building = Building::find($id);
        $data = $request->validate([
            'type_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'note' => 'sometimes',
            'facilities' => 'required',
            'operational_times' => 'required',
            'address' => 'required',
            'google_location_url' => 'sometimes',
            'phone' => 'required',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'star' => 'required|numeric|min:2|max:5',
            'is_bookable' => 'required',
            'is_active' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image_url')) {
            if($building->image_url != null) {
                Storage::delete($building->image_url);
            }

            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] =  $building->image_url;
        }

        $building->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/building");
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
            $building = Building::find($id);

            if($building->image_url) {
                Storage::delete($building->image_url);
            }

            $building->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/building");
        }
    }
}
