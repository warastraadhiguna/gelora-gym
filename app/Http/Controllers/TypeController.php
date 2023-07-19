<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =[
            'title' => "Manajemen Jenis Gedung",
            'content' => "admin/type/index"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =[
            'title' => "Tambah Jenis Gedung",
            'content' => "admin/type/add"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'index' => 'required|numeric|min:0',
        ]);

        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image_url')) {
            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] = null;
        }

        Type::create($data);
        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/building/type");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =[
            'title' => "Ubah Jenis Gedung",
            'type' => Type::find($id),
            'content' => "admin/type/add"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::find($id);
        $data = $request->validate([
            'name' => 'required',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'index' => 'required|numeric|min:0',
        ]);
        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image_url')) {
            if($type->image_url != null) {
                Storage::delete($type->image_url);
            }

            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] =  $type->image_url;
        }

        $type->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/building/type");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $type = Type::find($id);

            if($type->image_url) {
                Storage::delete($type->image_url);
            }


            $type->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/building/type");
        }
    }
}
