<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $value = $request->input("value");
            $payment = $request->input("payment");
            $receiptId = $request->input("receipt_id");
            $data = [
                "receipt_id" => $receiptId,
                "user_id" => auth()->user()->id,
                "value" => $value
            ];
            if($value == $payment) {
                $receipt = Receipt::find($receiptId);
                $receipt->update(["status" => "2"]);
            }

            Payment::create($data);
            DB::commit();
            return "";
        } catch(\Throwable $e) {
            DB::rollback();
            return $e->getMessage();
        }
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
            $payment = Payment::find($id);

            $payment->delete();
            return "";
        } catch(\Throwable $e) {
            return $e->getMessage();
        }
    }
}
