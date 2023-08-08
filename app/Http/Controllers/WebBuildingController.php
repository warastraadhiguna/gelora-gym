<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Schedule;
use App\Models\ReceiptDetail;
use App\Models\OperationalTime;

class WebBuildingController extends Controller
{
    public function index()
    {
        $bookedCourtArray = array();
        $bookedBuildingArray = array();

        $filter = GetScheduleFilter();
        $type_id = $filter[0];
        $date = $filter[1];
        $start_time = $filter[2];
        $end_time = $filter[3];
        $court_quantity = $filter[4];

        if($start_time && $end_time && $date) {
            $operationalTimes = OperationalTime::where([['name', '<=', $end_time], ['name', '>=', $start_time]])->get();

            $operationalTimeArray = array();
            foreach ($operationalTimes as $key => $operationalTime) {
                $operationalTimeArray[$key] =  $operationalTime->id;
            }

            $schedules = Schedule::where("is_active", "1")->whereIn('operational_time_id', $operationalTimeArray)->get();

            $scheduleArray = array();
            foreach ($schedules as $key => $schedule) {
                $scheduleArray[$key] =  $schedule->id ;
            }

            $receiptDetails = ReceiptDetail::where("booking_date", $date)->whereIn('schedule_id', $scheduleArray)->get();

            foreach ($receiptDetails as $key => $receiptDetail) {
                $bookedCourtArray[$key] = $receiptDetail->schedule->court->id;
            }

            $bookedCourtArray = array_unique($bookedCourtArray);
        }

        $buildings = $type_id ?
        Building::where([["is_active", "1"], ["type_id", $type_id]])->get()
        :
        Building::where("is_active", "1")->get();

        $i =0;
        foreach ($buildings as $key => $building) {
            if($building->is_bookable == "1" && count($building->courts) < $court_quantity) {
                $bookedBuildingArray[$i] = $building->id;
                $i++;
            }

            if($bookedCourtArray) {
                $courts = $building->courts->whereIn('id', $bookedCourtArray);
                if(count($building->courts) > 0 && (count($building->courts) - count($courts) === 0 || ($court_quantity && count($building->courts) - count($courts) < $court_quantity))) {
                    $bookedBuildingArray[$i] = $building->id;
                    $i++;
                }
            }
        }

        $data =[
            'content' => "main/building/index",
            'buildings' => $buildings->whereNotIn('id', $bookedBuildingArray),
            'type_id' => $type_id,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'court_quantity' => $court_quantity,
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function detail($id)
    {
        $filter = GetScheduleFilter();
        $type_id = $filter[0];
        $date = $filter[1];
        $start_time = $filter[2];
        $end_time = $filter[3];
        $court_quantity = $filter[4];

        $data =[
            'content' => "main/building/detail",
            'building' => Building::find($id),
            'type_id' => $type_id,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'court_quantity' => $court_quantity
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function searchBuilding()
    {
        $post = Request()->all();
        $date = isset($post['date']) && $post['date'] ? DateFormat(str_replace('/', '-', $post['date']), 'YYYY-MM-DD') : "";
        $startTime = isset($post['start_time']) && $post['start_time'] ? $post['start_time'] : "";
        $endTime = isset($post['end_time']) && $post['end_time'] ? $post['end_time'] : "";
        $courtQuantity = isset($post['court_quantity']) && $post['court_quantity'] ? $post['court_quantity'] : "";

        $defaultUrl = "/building?type_id=" . $post['type_id'] . "&date=" . $date . "&start_time=".   $startTime . "&end_time=" . $endTime. "&court_quantity=" . $courtQuantity;

        if(isset($post['building_id'])) {
            $building = Building::find($post['building_id']);
            if($building->is_bookable == "0") {
                return redirect($defaultUrl);
            }

            return redirect("/booking/". $post['building_id'] ."?type_id=" . $post['type_id'] . "&date=" . $date . "&start_time=". $startTime . "&end_time=" . $endTime. "&court_quantity=" . $courtQuantity);
        }

        return redirect($defaultUrl);
    }
}
