<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Building;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowTime = \Carbon\Carbon::now();
        $nowTimeString =DateFormat($nowTime, "Y-MM-DD");
        $endDate = Request()->input("endDate");
        $endDate = $endDate ? $endDate : $nowTimeString;
        $startDate = Request()->input("startDate");
        $startDate = $startDate ? $startDate : $nowTimeString;

        $status = Request()->input("status");
        $whereQuery = $status == "" ?
        [["created_at", "<=", $endDate . " 23:59:59"],["created_at", ">=", $startDate . " 00:00:00"]]
        :
        [["created_at", "<=", $endDate . " 23:59:59"],["created_at", ">=", $startDate . " 00:00:00"],["status", "=", $status]]
        ;

        $data =[
            'title' => "Manajemen Data Nota",
            'receipts' => Receipt::where($whereQuery)->orderby("status", "asc")->orderby("created_at", "desc")->get(),
            'content' => "admin/receipt/index",
            'endDate' => $endDate,
            'startDate' => $startDate,
            'status' => $status,
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
            'title' => "Tambah Data Nota",
            'content' => "admin/receipt/add"
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
        $receipt_id = Request()->input("receipt_id");
        if(!$receipt_id) {
            Alert::error('Error', "Pilih nota!!");

            return redirect("/admin/receipt");
        }

        $receipt = Receipt::find($receipt_id);
        $data = $request->validate([
            'status' => 'required',
        ]);

        $data['updated_user_id'] = auth()->user()->id;

        if($receipt->status === '0' && $data['status'] === '2') {
            Alert::error('Error', "Nota harus dibayar dahulu!!" . $receipt->status);

            return redirect("/admin/receipt");
        }

        $receipt->update($data);
        Alert::success('Sukses', 'Data berhasil diubah.');

        return redirect("/admin/receipt");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receipt =  Receipt::find($id);
        $building_id = $receipt->receiptDetails[0]->schedule->court->building_id;

        $data =[
            'title' => "Detail Data Nota",
            'content' => "admin/receipt/detail",
            'building' => Building::find($building_id),
            'receipt' => $receipt
        ];

        return view("admin.layouts.wrapper", $data);
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
            'title' => "Ubah Data Nota",
            'receipt' => Receipt::find($id),
            'content' => "admin/receipt/add"
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
        $receipt = Receipt::find($id);
        $data = $request->validate([
            'status' => 'required',
        ]);

        $receipt->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/receipt");
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
            if(auth()->user()->role === "admin") {
                Alert::error('Error', "Anda tidak berhak mengakses fitur ini");

                return redirect("/admin/receipt");
            }

            $receipt = Receipt::find($id);

            if($receipt->image_url) {
                Storage::delete($receipt->image_url);
            }

            $receipt->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/receipt");
        }
    }
}