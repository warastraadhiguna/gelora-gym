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
use App\Models\Payment;
use App\Models\TempBookingDetail;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class WebBookingController extends Controller
{
    public function detail($id)
    {
        $building = Building::find($id);
        $element = Request()->input("element");
        $page = Request()->input("page");
        $filter = Request()->input("filter");
        $court_ids = Request()->input("court_ids");

        $courtIdArray = $court_ids ? explode(",", $court_ids) : [];
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

        //temp booking and receipts delete last 15 minute ago
        $tenMinutesAgo = DateConvert(DateFormat(\Carbon\Carbon::now()->addMinutes(-20), "Y/M/D HH:mm:ss"));
        TempBookingDetail::where([['created_at', '<=', $tenMinutesAgo]])->delete();
        Receipt::where([['created_at', '<=', $tenMinutesAgo], ['status', '0'] ])->delete();


        $page = $page ? $page : 0;
        $repeatedDay = $repeatedDay ? $repeatedDay : 1;
        $repeatedPeriod = $repeatedPeriod ? $repeatedPeriod : 0;

        $showModalOnLoad = !$filter && ($date || $start_time || $end_time);

        $nowTime = \Carbon\Carbon::now();
        $nowDate = $nowTime;
        $nowTime->addDays($page * 7);
        $nowTimes = array(); //time for every court, every court should has their our time
        foreach ($building->courts as $key => $court) {
            $nowTimes[$key] =  DateConvert(DateFormat($nowTime, "Y/M/D"));
        }

        if($filter == '1') {
            $errorMessage = $this->reserveFromFilter($filters, $repeatedDay, $repeatedPeriod, $id, $courtIdArray);
            if(!$errorMessage) {
                $successMessage = "Data berhasil disimpan sesuai filter yang anda terapkan. ";
            }
        }

        //// search booked schedule from details side old school
        // $bookingDetails = ReceiptDetail::with('receipt')->where([['booking_date','>=',DateFormat($nowTime, "YYYY/MM/DD")]])->get();

        //// search booked schedule from details side new ways
        $bookedDetails = ReceiptDetail::getBooked($nowTime);
        $bookedSchedulesString = "";
        $bookedSchedulesInformation = "";

        $isUser = auth()->user()->role == "user";
        for ($i = 0; $i < count($bookedDetails); $i++) {
            $bookingDetail = $bookedDetails[$i];

            $interval = date_create($nowTime->toDateString())->diff(date_create($bookingDetail->booking_date));
            $bookedSchedulesString = $bookedSchedulesString . 'link_' . $bookingDetail->schedule_id . '_' . ($page * 7 + $interval->format("%d")) . ";";
            if($isUser) {
                $bookedSchedulesInformation = $bookedSchedulesInformation . "Data sudah dibooking pelanggan lain!!;";
            } else {
                $bookedSchedulesInformation =  $bookedSchedulesInformation . "Data sudah dibooking " . $bookingDetail->name . "-" . $bookingDetail->number . "-" . $bookingDetail->note.  ";";
            }
        }
        // dd($bookedSchedulesString);

        $tempBookingDetails = TempBookingDetail::where([['user_id',auth()->user()->id]])->get();

        $tempBookingDetailString = "";
        $totalPaid = 0;

        foreach ($tempBookingDetails as $key => $tempBookingDetail) {
            $interval = date_create($nowTime->toDateString())->diff(date_create($tempBookingDetail->booking_date));
            $tempBookingDetailString = $tempBookingDetailString . 'link_' . $tempBookingDetail->schedule_id . '_' . ($page * 7 + $interval->format("%d")) . ";";

            $totalPaid = $totalPaid + $tempBookingDetail->schedule->price;
        }

        $tempBookingDetails = TempBookingDetail::where([['user_id', auth()->user()->id],['booking_date', '>=',DateFormat($nowTime, "Y/M/D")]])->get();


        // $weeklyBookingDetails = Schedule::whereHas('weeklyBookingDetails')->orderby('id', 'asc')->get();

        // foreach ($weeklyBookingDetails as $weeklyBookingDetail) {
        //     $bookedSchedulesString = $bookedSchedulesString . 'link_' . $weeklyBookingDetail->id . '_' . ($page*7 + $weeklyBookingDetail->operational_day_id - 1) . ";";
        // }
        // dd($bookedSchedulesString);,
        $totalPaidString = "Rp. " . NumberFormat($totalPaid) . ",-";
        $html = view('main/booking/modal', array('building_id' => $building->id,'date' => $date,'start_time' => $start_time, 'end_time' => $end_time , 'court_quantity' => $court_quantity, 'repeatedDay' => $repeatedDay, 'repeatedPeriod' => $repeatedPeriod, 'building' => $building, 'courtIdArray' => $courtIdArray ))->render();
        $bookingHtml = view('main/booking/booking-tutorial-modal')->render();
        $continueProcessHtml = view('main/booking/continue-process-modal', array('building_id' => $building->id, 'totalPaidString' =>  $totalPaidString))->render();

        $data = [
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
            'bookedSchedulesInformation' => $bookedSchedulesInformation,
            'tempBookingDetailString' => $tempBookingDetailString,
            'html' =>  trim(preg_replace('/\s+/', ' ', $html)),
            'bookingHtml' =>  trim(preg_replace('/\s+/', ' ', $bookingHtml)),
            'continueProcessHtml' =>  trim(preg_replace('/\s+/', ' ', $continueProcessHtml)),
            'totalPaidString' =>  $totalPaidString,
            'code' => ''
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function filter()
    {
        $post = Request()->all();
        $courtIds = isset($post['courd_id']) ? $post['courd_id'] : [];
        $courtIdAll = "";
        foreach ($courtIds as $courtId) {
            $courtIdAll = $courtIdAll . (string)$courtId . ",";
        }

        $date = $post['date'] ? DateFormat(str_replace('/', '-', $post['date']), 'YYYY-MM-DD') : "";

        return redirect("/booking" . "/" . $post['building_id'] . "?date=" . $date . "&start_time=" . $post['start_time'] . "&end_time=" . $post['end_time'] . "&court_quantity=" . $post['court_quantity'] . "&repeatedDay=" . $post['repeatedDay'] . "&repeatedPeriod=" . $post['repeatedPeriod'] . "&filter=1&court_ids=$courtIdAll");
    }

    public function reserve(Request $request)
    {
        $schedule_id = $request->input("id");
        $iteration = $request->input("iteration");

        $nowTime = \Carbon\Carbon::now();
        $nowTime->addDays($iteration);

        $data = [
            'user_id' => auth()->user()->id,
            'schedule_id' => $schedule_id,
            'booking_date' => DateFormat($nowTime, "Y/M/D")
        ];
        TempBookingDetail::create($data);

        $tempBookingDetails = TempBookingDetail::where([['user_id',auth()->user()->id]])->get();
        $totalPaid = 0;

        foreach ($tempBookingDetails as $tempBookingDetail) {
            $totalPaid = $totalPaid + $tempBookingDetail->schedule->price;
        }

        echo "Rp. " . NumberFormat($totalPaid) . ",-";
    }

    public function deleteReserve(Request $request)
    {
        $schedule_id = $request->input("id");
        $iteration = $request->input("iteration");

        $nowTime = \Carbon\Carbon::now();
        $nowTime->addDays($iteration);

        $tempBookingDetail = TempBookingDetail::where([['user_id', auth()->user()->id],['schedule_id', $schedule_id],['booking_date',DateFormat($nowTime, "Y/M/D")]])->first();

        $tempBookingDetail->delete();

        $tempBookingDetails = TempBookingDetail::where([['user_id',auth()->user()->id]])->get();
        $totalPaid = 0;

        foreach ($tempBookingDetails as $tempBookingDetail) {
            $totalPaid = $totalPaid + $tempBookingDetail->schedule->price;
        }

        echo "Rp. " . NumberFormat($totalPaid) . ",-";

    }

    public function checkout($id)
    {
        $nowTime = \Carbon\Carbon::now();

        $tempBookingDetails = TempBookingDetail::where([['user_id', auth()->user()->id],['booking_date', '>=',DateFormat($nowTime, "Y/M/D")]])->get();

        $total = 0;
        foreach ($tempBookingDetails as $tempBookingDetail) {
            $total = $total + $tempBookingDetail->schedule->price;
        }

        $data = [
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
            'status' => 'sometimes',
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
                    $errorMessage = $errorMessage . DateFormat($tempBookingDetail->booking_date, "DD MMMM YY") . "=>" . $tempBookingDetail->schedule->operationalTime->name . "; \n\r";
                }

                // $weeklyBookingDetailExist = WeeklyBookingDetail::where([['schedule_id', $tempBookingDetail->schedule_id]])->first();

                // if($weeklyBookingDetailExist) {
                //     $errorMessage = $errorMessage . DateFormat($tempBookingDetail->booking_date, "DD MMMM YY") . "=>" . $tempBookingDetail->schedule->operationalTime->name . "; ";
                // }
            }

            if($errorMessage) {
                DB::rollback();
                Alert::error('Error', "Terdapat jadwal yang sudah dibooking diwaktu yang sama!! Silahkan hapus jadwal yang dicoret!!");
                $tempBookingDetails->update(['is_booked' => '1']);

                return redirect("checkout/" . $buildingId);
            }

            ReceiptDetail::insert($insertedData);
            $tempBookingDetails->delete();

            DB::commit();

            //3 for blocking data
            if(isset($data['status']) && $data['status'] === "3") {
                return redirect("admin/receipt");

            } else {
                return redirect("midtrans-payment" . "/" . $newReceipt->id);
            }
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Error', $e->getMessage());
            return redirect("checkout/" . $buildingId);
        }
    }

    public function midtransPayment($id)
    {
        try {

            // Set your Merchant Server Key
            Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            Config::$isProduction = config('midtrans.is_production');
            // Set sanitization on (default)
            Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            Config::$is3ds = true;

            $receipt = Receipt::find($id);
            if($receipt == null) {
                return redirect("/");
            }

            $receipt = Receipt::find($id);
            $data['user_id'] = auth()->user()->id;
            $receipt->update($data);

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

            $data = [
                'content' => "main/booking/midtrans-payment",
                'receipt' => $receipt,
                'snapToken' => $snapToken,
                'building' => $receipt->receiptDetails[0]->schedule->court->building,
                'nowTime' => \Carbon\Carbon::now(),
                'total' => $total,
            ];

            return view("main.layouts.wrapper", $data);
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $receipt = Receipt::find($request->order_id);
                $receipt->update(['status' => '2']);

                Payment::create([
                    "receipt_id" => $request->order_id,
                    "user_id" => $receipt->user_id,
                    "value" => $request->gross_amount
                ]);
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

        $data = [
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
        $building_id = $receipt->receiptDetails[0]->schedule->court->building_id;

        $data = [
            'content' => "main/booking/receipt",
            'building' => Building::find($building_id),
            'receipt' => $receipt,
            'receiptDetailArray' => collect($receiptDetailArray)->sortBy('court', null, true)->reverse()->toArray(),
            'total' => $total,
        ];

        return view("main.layouts.wrapper", $data);
    }
    private function reserveFromFilter($filters, $repeatedDay, $repeatedPeriod, $building_id, $courtIdArray)
    {
        $date = $filters[1];
        $start_time = $filters[2];
        $end_time = $filters[3];
        $court_quantity = $filters[4];
        $repeatedDayValue = $repeatedDay == "1" ? 0 : $repeatedDay;
        // dd($repeatedDay);

        if($courtIdArray && $court_quantity != sizeof($courtIdArray) - 1) {
            return "Jumlah lapangan yang dibutuhkan tidak sama dengan jumlah lapangan yang dipilih!!";
        }

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

            $courtQuery = Court::where([['building_id', "=" ,$building_id], ["is_active", "1"]]);
            if($courtIdArray) {
                $courtQuery->whereIn('id', $courtIdArray);
            }

            $courts = $courtQuery->get();
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
                for ($i = 0; $i <= $repeatedPeriod; $i++) {
                    //if repeated day value = 0 = a day, follow $i else (weekly/mouthly) * i
                    $repeatedFormula = $repeatedDayValue == 0 ? $i : $repeatedDayValue * $i;
                    $choosenDate = DateConvert($dateStringDefault)->addDays($repeatedFormula);

                    //angling set sunday to be 7 in database, but in the real day should be 0
                    $operationalDayNumber = $choosenDate->dayOfWeek === 0 ? 7 : $choosenDate->dayOfWeek;

                    $schedules = Schedule::where([["is_active", "1"], ["operational_day_id", $operationalDayNumber], ["court_id", $court->id]])->whereIn('operational_time_id', $operationalTimeArray)->get();

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
            for($i = 0; $i < $court_quantity; $i++) {
                foreach ($tempBookingPerCourtArray[$i] as $tempBookingPerSchedule) {
                    $tempBookingDetails[$tempBookingDetailIndex] = $tempBookingPerSchedule;
                    $tempBookingDetailIndex++;
                }
            }

            if(($court_quantity * count($operationalTimes) * ($repeatedPeriod + 1)) != count($tempBookingDetails)) {
                return "Terdapat jadwal yang tidak tersedia!!";
            }

            TempBookingDetail::insert($tempBookingDetails);
            return "";
        }
    }
}
