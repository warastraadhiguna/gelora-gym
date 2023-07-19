<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =[
            'title' => "Manajemen Keunggulan Kami",
            'benefits' => Benefit::get(),
            'content' => "admin/benefit/index"
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
            'title' => "Tambah Keunggulan Kami",
            'content' => "admin/benefit/add"
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
            'note' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        Benefit::create($data);
        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/web/benefit");
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
            'title' => "Ubah Keunggulan Kami",
            'benefit' => Benefit::find($id),
            'content' => "admin/benefit/add"
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
        $benefit = Benefit::find($id);
        $data = $request->validate([
            'name' => 'required',
            'note' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        $benefit->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/web/benefit");
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
            $inventoryBenefit = Benefit::find($id);
            $inventoryBenefit->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/web/benefit");
        }
    }
}
