<?php

namespace App\Http\Controllers;

use Exception;

// use Midtrans\Snap;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Court;
use App\Models\Receipt;
use App\Models\Building;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\ReceiptDetail;
use App\Models\OperationalTime;
use App\Models\TempBookingDetail;
use Illuminate\Support\Facades\DB;
use App\Models\WeeklyBookingDetail;
use RealRashid\SweetAlert\Facades\Alert;

class WebBookingController extends Controller
{
    public function detail($id)
    {
        $building = Building::find($id);
        $element = Request()->input("element");
        $page = Request()->input("page");
        $filter = Request()->input("filter");

        $filters = GetScheduleFilter();
        $date = $filters[1];
        $start_time = $filters[2];
        $end_time = $filters[3];
        $court_quantity = $filters[4];
        $repeatedDay = Request()->input("repeatedDay");
        $repeatedPeriod = Request()->input("repeatedPeriod");
        $errorMessage = "";
        $successMessage = "";

        if($page == "") {
            TempBookingDetail::where([['user_id', auth()->user()->id]])->delete();
        }

        $page = $page ? $page : 0;
        $repeatedDay = $repeatedDay ? $repeatedDay : 1;
        $repeatedPeriod = $repeatedPeriod ? $repeatedPeriod : 0;

        $showModalOnLoad = !$filter && ($date|| $start_time|| $end_time);

        $nowTime = \Carbon\Carbon::now();
        $nowDate = $nowTime;
        $nowTime->addDay($page*7);
        $nowTimes = array(); //time for every court, every court should has their our time
        foreach ($building->courts as $key => $court) {
            $nowTimes[$key] =  DateConvert(DateFormat($nowTime, "Y/M/D"));
        }

        if($filter == '1') {
            $errorMessage = $this->reserveFromFilter($filters, $repeatedDay, $repeatedPeriod, $id);
            if(!$errorMessage) {
                $successMessage = "Data berhasil disimpan sesuai filter yang anda terapkan..";
            }
        }

        $bookingDetails = ReceiptDetail::where([['booking_date','>=',DateFormat($nowTime, "YYYY/MM/DD")]])->get();

        $bookedSchedulesString = "";
        for ($i=0; $i < count($bookingDetails); $i++) {
            $bookingDetail = $bookingDetails[$i];

            $interval = date_create($nowTime->toDateString())->diff(date_create($bookingDetail->booking_date));
            $bookedSchedulesString = $bookedSchedulesString . 'link_' . $bookingDetail->schedule_id . '_' . ($page*7 + $interval->format("%d")) . ";";
        }


        $tempBookingDetails = TempBookingDetail::where([['user_id',auth()->user()->id]])->get();
        $tempBookingDetailString = "";
        foreach ($tempBookingDetails as $key => $tempBookingDetail) {
            $interval = date_create($nowTime->toDateString())->diff(date_create($tempBookingDetail->booking_date));
            $tempBookingDetailString = $tempBookingDetailString . 'link_' . $tempBookingDetail->schedule_id . '_' . ($page*7 + $interval->format("%d")) . ";";
        }



        // $weeklyBookingDetails = Schedule::whereHas('weeklyBookingDetails')->orderby('id', 'asc')->get();

        // foreach ($weeklyBookingDetails as $weeklyBookingDetail) {
        //     $bookedSchedulesString = $bookedSchedulesString . 'link_' . $weeklyBookingDetail->id . '_' . ($page*7 + $weeklyBookingDetail->operational_day_id - 1) . ";";
        // }
        // dd($bookedSchedulesString);

        $html = view('main/booking/modal', array('building_id' => $building->id,'date' => $date,'start_time' => $start_time, 'end_time' => $end_time , 'court_quantity' => $court_quantity, 'repeatedDay' => $repeatedDay, 'repeatedPeriod' => $repeatedPeriod ))->render();

        $data =[
            'content' => "main/booking/detail",
            'building' => $building,
            'nowDayNumber' => $nowTime->dayOfWeek,
            'nowTime' => $nowTime,
            'nowTimes' => $nowTimes,
            'nowDate' => $nowDate,
            'page' => $page,
            'element' => $element,
            'showModalOnLoad' => $showModalOnLoad,
            'errorMessage' => $errorMessage,
            'successMessage' => $successMessage,
            'bookedSchedulesString' => $bookedSchedulesString,
            'tempBookingDetailString' => $tempBookingDetailString,
            'html' =>  trim(preg_replace('/\s\s+/', ' ', $html)),
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function filter()
    {
        $post = Request()->all();
        $date = $post['date'] ? DateFormat(str_replace('/', '-', $post['date']), 'YYYY-MM-DD') : "";

        return redirect("/booking". "/" . $post['building_id'] ."?date=" . $date . "&start_time=". $post['start_time'] . "&end_time=" . $post['end_time']. "&court_quantity=" . $post['court_quantity']. "&repeatedDay=" . $post['repeatedDay'] . "&repeatedPeriod=" . $post['repeatedPeriod']. "&filter=1");
    }

    public function reserve(Request $request)
    {     
        $schedule_id = $request->input("id");
        $iteration = $request->input("iteration");

        $nowTime = \Carbon\Carbon::now();
        $nowTime->addDay($iteration);

        $data=[
            'user_id'=> auth()->user()->id,
            'schedule_id' => $schedule_id,
            'booking_date' => DateFormat($nowTime, "Y/M/D")
        ];
        TempBookingDetail::create($data);
        echo "success";
    }

    public function deleteReserve(Request $request)
    {
        $schedule_id = $request->input("id");
        $iteration = $request->input("iteration");

        $nowTime = \Carbon\Carbon::now();
        $nowTime->addDay($iteration);

        $tempBookingDetail = TempBookingDetail::where([['user_id', auth()->user()->id],['schedule_id', $schedule_id],['booking_date',DateFormat($nowTime, "Y/M/D")]])->first();

        $tempBookingDetail->delete();
        echo "success";
    }

    public function checkout($id)
    {
        $nowTime = \Carbon\Carbon::now();

        $tempBookingDetails = TempBookingDetail::where([['user_id', auth()->user()->id],['booking_date', '>=',DateFormat($nowTime, "Y/M/D")]])->get();

        $total = 0;
        foreach ($tempBookingDetails as $tempBookingDetail) {
            $total = $total + $tempBookingDetail->schedule->price;
        }

        $data =[
            'content' => "main/booking/checkout",
            'building' => Building::find($id),
            'nowTime' => $nowTime,
            'tempBookingDetails' => $tempBookingDetails,
            'total' => $total,
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function deleteBooking(Request $request)
    {
        $id = $request->input("id");

        $tempBookingDetail = TempBookingDetail::find($id);

        $tempBookingDetail->delete();
        echo "success";
    }

    public function payment(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'sometimes|email:rfc,dns',
            'phone' => 'required|numeric',
            'note' => 'sometimes',
            'building_id' => 'sometimes',
        ]);
        $buildingId = $data['building_id'];

        try {
            $nowTime = \Carbon\Carbon::now();
            $tempBookingDetails = TempBookingDetail::where([['user_id', auth()->user()->id],['booking_date', '>=',DateFormat($nowTime, "Y/M/D")]]);

            if(count($tempBookingDetails->get()) == 0) {
                return redirect("building");
            }

            $data['user_id'] = auth()->user()->id;
            unset($data['building_id']);
            $data['number'] = GetNumber("R/" . DateFormat($nowTime, "Y/M/"), Receipt::whereYear('created_at', '=', DateFormat($nowTime, "Y"))
            ->whereMonth('created_at', '=', DateFormat($nowTime, "M"))->get());

            DB::beginTransaction();

            $newReceipt = Receipt::create($data);

            $insertedData = array();
            $i = 0;
            $errorMessage = "";
            foreach ($tempBookingDetails->get() as $tempBookingDetail) {
                $insertedData[$i] = [
                    'receipt_id' => $newReceipt->id,
                    'schedule_id' => $tempBookingDetail->schedule_id,
                    'booking_date' => $tempBookingDetail->booking_date,
                    'price' => $tempBookingDetail->schedule->price
                ];
                $i++;

                $tempBookingDetailExist = ReceiptDetail::where([['schedule_id', $tempBookingDetail->schedule_id],['booking_date', '=',DateFormat($tempBookingDetail->booking_date, "Y/M/D")]])->first();

                if($tempBookingDetailExist) {
                    $errorMessage = $errorMessage . DateFormat($tempBookingDetail->booking_date, "DD MMMM YY") . "=>" . $tempBookingDetail->schedule->operationalTime->name . "; ";
                }

                $weeklyBookingDetailExist = WeeklyBookingDetail::where([['schedule_id', $tempBookingDetail->schedule_id]])->first();

                if($weeklyBookingDetailExist) {
                    $errorMessage = $errorMessage . DateFormat($tempBookingDetail->booking_date, "DD MMMM YY") . "=>" . $tempBookingDetail->schedule->operationalTime->name . "; ";
                }
            }

            if($errorMessage) {
                DB::rollback();
                Alert::error('Error', "Terdapat jadwal yang sudah dibooking diwaktu yang sama!! Antara lain : " . $errorMessage);
                return redirect("checkout/" . $buildingId);
            }

            ReceiptDetail::insert($insertedData);
            $tempBookingDetails->delete();

            DB::commit();

            return redirect("midtrans-payment" . "/" . $newReceipt->id);
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Error', $e->getMessage());
            return redirect("checkout/" . $buildingId);
        }
    }

    public function midtransPayment($id)
    {

        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $receipt = Receipt::find($id);
        $total = 0;
        foreach ($receipt->receiptDetails as $receiptDetail) {
            $total = $total + $receiptDetail->price;
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' =>  $receipt->name,
                'last_name' =>  '',                
                'email' => $receipt->email,
                'phone' => $receipt->phone,
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        $data =[
            'content' => "main/booking/midtrans-payment",
            'receipt' => $receipt,            
            'snapToken' => $snapToken,
            'building' => $receipt->receiptDetails[0]->schedule->court->building,
            'nowTime' => \Carbon\Carbon::now()
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $receipt = Receipt::find($request->order_id);
                $receipt->update(['status'=>'1']);
            }
        }
    }

    public function success($id)
    {
        $receipt = Receipt::find($id);
        if($receipt == null) {
            return redirect("/");
        }

        if($receipt->user_id != auth()->user()->id) {
            return redirect("/");
        }

        $building_id = $receipt->receiptDetails[0]->schedule->court->building_id;

        $data =[
            'content' => "main/booking/success",
            'building' => Building::find($building_id),
            'receipt' => $receipt,
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function receipt($id)
    {
        $receipt = Receipt::find($id);
        if($receipt == null) {
            return redirect("/");
        }

        if($receipt->user_id != auth()->user()->id) {
            return redirect("/");
        }

        $building_id = $receipt->receiptDetails[0]->schedule->court->building_id;

        $data =[
            'content' => "main/booking/receipt",
            'building' => Building::find($building_id),
            'receipt' => $receipt,
        ];

        return view("main.layouts.wrapper", $data);
    }

    private function reserveFromFilter($filters, $repeatedDay, $repeatedPeriod, $building_id)
    {
        $date = $filters[1];
        $start_time = $filters[2];
        $end_time = $filters[3];
        $court_quantity = $filters[4];
        $repeatedDayValue = $repeatedDay == "1" ? 0 : $repeatedDay;

        if($start_time && $end_time && $date) {
            $nowTime = \Carbon\Carbon::now();
            $nowTimeString = DateFormat($nowTime, "YYYY/MM/DD HH:mm");

            if(($nowTimeString > DateFormat($date . " $end_time", "YYYY/MM/DD HH:mm")) || (($nowTimeString <= DateFormat($date . " $end_time", "YYYY/MM/DD HH:mm")) && ($nowTimeString >= DateFormat($date . " $start_time", "YYYY/MM/DD HH:mm")))) {
                return "Waktu saat ini, sudah melewati jadwal yang anda pilih!";
            }

            $operationalTimes = OperationalTime::where([['name', '<=', $end_time], ['name', '>=', $start_time]])->get();
            $operationalTimeArray = array();
            foreach ($operationalTimes as $key => $operationalTime) {
                $operationalTimeArray[$key] =  $operationalTime->id;
            }

            $courts = Court::where([['building_id', "=" ,$building_id], ["is_active", "1"]])->get();
            if(count($courts) < $court_quantity) {
                return "Jumlah lapangan yang dibutuhkan tidak tersedia!!";
            }

            $dateStringDefault = DateFormat($date, 'YYYY/MM/DD');

            $courtIndex = 0;
            $tempBookingPerCourtArray = array();

            foreach ($courts as $court) {
                $isAvailableCourt = true;

                $tempBookingPerScheduleArray = array();
                $tempBookingPerScheduleIndex = 0;
                for ($i=0; $i <= $repeatedPeriod; $i++) {
                    $repeatedFormula = $repeatedDayValue == 0 ? $i : $repeatedDayValue * $i;

                    $choosenDate = DateConvert($dateStringDefault)->addDay($repeatedFormula);

                    $schedules = Schedule::where([["is_active", "1"], ["operational_day_id", $choosenDate->dayOfWeek], ["court_id", $court->id]])->whereIn('operational_time_id', $operationalTimeArray)->get();

                    $dateString = $choosenDate->isoFormat('YYYY/MM/DD');

                    foreach ($schedules as $schedule) {
                        $receiptDetailExist = ReceiptDetail::where([['schedule_id', $schedule->id], ['booking_date', $dateString]])->first();
                        if($receiptDetailExist) {
                            $isAvailableCourt = false;
                            break;
                        }

                        $tempBookingDetail["user_id"] = auth()->user()->id;
                        $tempBookingDetail["schedule_id"] = $schedule->id;
                        $tempBookingDetail["booking_date"] = $dateString;
                        // $tempBookingDetail["courd_id"] = $court->id;
                        $tempBookingPerScheduleArray[$tempBookingPerScheduleIndex] = $tempBookingDetail;
                        $tempBookingPerScheduleIndex++;
                    } //end of schedule foreach

                    if(!$isAvailableCourt) {
                        break;
                    }
                } //end of repeated period foreach

                if($isAvailableCourt) {
                    $tempBookingPerCourtArray[$courtIndex] = $tempBookingPerScheduleArray;
                    $courtIndex++;
                }
            } // end of court foreach

            if(count($tempBookingPerCourtArray) < $court_quantity) {
                return "Jumlah lapangan yang dibutuhkan tidak tersedia!!";
            }

            $tempBookingDetails = array();
            $tempBookingDetailIndex = 0;
            for($i=0; $i<$court_quantity; $i++) {
                foreach ($tempBookingPerCourtArray[$i] as $tempBookingPerSchedule) {
                    $tempBookingDetails[$tempBookingDetailIndex] = $tempBookingPerSchedule;
                    $tempBookingDetailIndex++;
                }
            }

            TempBookingDetail::insert($tempBookingDetails);
            return "";
        }
    }
}