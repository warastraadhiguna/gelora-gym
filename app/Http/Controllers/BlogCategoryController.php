<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =[
            'title' => "Manajemen Kategori Blog",
            'content' => "admin/blog-category/index"
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
            'title' => "Tambah Kategori Blog",
            'content' => "admin/blog-category/add"
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
        ]);

        $data['user_id'] = auth()->user()->id;

        BlogCategory::create($data);
        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/web/blog-category");
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
            'title' => "Ubah Kategori Blog",
            'blogCategory' => BlogCategory::find($id),
            'content' => "admin/blog-category/add"
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
        $blogCategory = BlogCategory::find($id);
        $data = $request->validate([
            'name' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        $blogCategory->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/web/blog-category");
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
            $inventoryBlogCategory = BlogCategory::find($id);
            $inventoryBlogCategory->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/web/blog-category");
        }
    }
}