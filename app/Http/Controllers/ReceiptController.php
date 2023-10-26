<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Building;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\ReceiptDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $nowTime = \Carbon\Carbon::now();
        $nowTimeString = DateFormat($nowTime, "Y-MM-DD");
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

        $data = [
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
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'title' => "Tambah Data Nota",
            'content' => "admin/receipt/add"
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
        $receipt_id = $request->input("receipt_id");
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
            Alert::error('Error', "Nota harus dibayar dahulu!!");

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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $receipt =  Receipt::find($id);
        $building_id = $receipt->receiptDetails[0]->schedule->court->building_id;
        $total = 0;
        $receiptDetailArray = array();
        $i = 0;
        foreach ($receipt->receiptDetails as $receiptDetail) {
            $isFound = false;

            for ($j = 0; $j < count($receiptDetailArray); $j++) {
                if($receiptDetail->schedule->court->name === $receiptDetailArray[$j]['court'] && DateFormat($receiptDetail->booking_date, "D MMMM Y") === $receiptDetailArray[$j]['date']) {
                    $receiptDetailArray[$j]['schedule'] = $receiptDetailArray[$j]['schedule'] . ', ' . $receiptDetail->schedule->operationalTime->name;
                    $receiptDetailArray[$j]['price'] = $receiptDetailArray[$j]['price'] + $receiptDetail->price;

                    $isFound = true;
                    break;
                }
            }

            if(!$isFound) {
                $receiptDetailArray[$i] = [
                    'court' => $receiptDetail->schedule->court->name,
                    'date' => DateFormat($receiptDetail->booking_date, "D MMMM Y"),
                    'real_date' => $receiptDetail->booking_date,
                    'schedule' => $receiptDetail->schedule->operationalTime->name,
                    'price' => $receiptDetail->price
                ];
                $i++;
            }

            $total = $total + $receiptDetail->price;
        }
        $receiptDetailArray = collect($receiptDetailArray)->sortBy('real_date', null, false)->reverse()->toArray();

        $data = [
            'title' => "Detail Data Nota",
            'content' => "admin/receipt/detail",
            'building' => Building::find($building_id),
            'receiptDetailArray' => collect($receiptDetailArray)->sortBy('court', null, true),
            'receipt' => $receipt,
            'total' => $total
        ];

        return view("admin.layouts.wrapper", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
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
    * @return \Illuminate\Http\RedirectResponse/Illuminate\Routing\Redirector
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
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
* @return \Illuminate\Http\RedirectResponse/Illuminate\Routing\Redirector
 */

    public function changeDate(Request $request)
    {
        $data = $request->validate([
            'receipt_id' => 'required',
            'booking_date' => 'required',
            'new_date' => 'required',
        ]);

        $model = ReceiptDetail::with('receipt', 'schedule')->where([['receipt_id', $data['receipt_id']], ['booking_date', $data['booking_date']]]);
        $details = $model->get();
        $insertedData = array();
        $i = 0;

        $availableSchedule = true;

        foreach ($details as $detail) {
            $schedule = Schedule::where([['court_id', $detail->schedule->court_id], ['operational_time_id', $detail->schedule->operational_time_id], ['operational_day_id',\Carbon\Carbon::parse($data['new_date'])->dayOfWeek]])->first();
            if ($schedule) {
                $insertedData[$i] = [
                    'receipt_id' => $data['receipt_id'],
                    'schedule_id' => $schedule->id,
                    'booking_date' =>  $data['new_date'],
                    'price' => $schedule->price
                ];

                $i++;
            } else {
                $availableSchedule = false;
                break;
            }
        }
        if(!$availableSchedule) {
            Alert::error('Error', 'Terdapat jadwal yang tidak dapat digeser karena tidak tersedia.');
        } else {
            $isFound = false;
            foreach ($insertedData as $insertedSingle) {
                $foundData = ReceiptDetail::where([['schedule_id', $insertedSingle['schedule_id']], ['booking_date', $data['booking_date']]])->first();

                if ($foundData) {
                    $isFound = true;
                    break;
                }
            }

            if(!$isFound) {
                try {
                    DB::beginTransaction();
                    $model->delete();

                    ReceiptDetail::insert($insertedData);
                    Alert::success('Sukses', 'Data berhasil diupdate.');

                    DB::commit();

                } catch (\Throwable $th) {
                    DB::rollback();
                    Alert::error('Error', 'Terdapat gangguan saat menambah data..');
                }
            } else {
                Alert::error('Error', 'Data pada tanggal digeser, sudah digunakan orang lain');
            }
        }

        return redirect("/admin/receipt/" . $data['receipt_id']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
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
