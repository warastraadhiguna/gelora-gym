<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\OperationalDay;
use App\Models\OperationalTime;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function index()
    {
        $court_id = Request()->input("court_id");

        $data =[
            'title' => "Manajemen Data Jadwal",
            'mondaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "1"]])->orderBy("operational_time_id", "asc")->get(),
            'tuesdaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "2"]])->orderBy("operational_time_id", "asc")->get(),
            'wednesdaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "3"]])->orderBy("operational_time_id", "asc")->get(),
            'thursdaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "4"]])->orderBy("operational_time_id", "asc")->get(),
            'fridaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "5"]])->orderBy("operational_time_id", "asc")->get(),
            'saturdaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "6"]])->orderBy("operational_time_id", "asc")->get(),
            'sundaySchedules' => Schedule::where([["court_id", $court_id],["operational_day_id", "7"]])->orderBy("operational_time_id", "asc")->get(),
            'courts' => Court::where("is_active", "=", "1")->get(),
            'content' => "admin/schedule/index",
            'court_id' => $court_id
        ];

        return view("admin.layouts.wrapper", $data);
    }
    public function create()
    {
        $court_id = Request()->input("court_id");
        $operational_day_id = Request()->input("operational_day_id");

        if(!$court_id) {
            Alert::error('Error', "Gedung tidak ditemukan");
            return redirect("/admin/schedule");
        }

        $court = Court::find($court_id);
        if(!$court) {
            Alert::error('Error', "Gedung tidak ditemukan");
            return redirect("/admin/schedule");
        }

        $data =[
            'title' => "Tambah Data Jadwal",
            'content' => "admin/schedule/add",
            'schedules' => $operational_day_id ? (Schedule::where([["court_id", $court_id],["operational_day_id", $operational_day_id]])->orderBy("operational_time_id", "asc")->get()) : null,
            'operationalDays' => OperationalDay::orderBy("index", "ASC")->get(),
            'operationalTimes' => OperationalTime::orderBy("index", "ASC")->get(),
            'court_id' => $court_id,
            'operational_day_id' => $operational_day_id
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'court_id' => 'required',
            'operational_day_id' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;
        $operationalTimes = OperationalTime::orderBy("index", "ASC")->get();

        foreach ($operationalTimes as $operationalTime) {
            $timeValue = Request()->input("time_" . $operationalTime->id);
            $price = Request()->input("price_" . $operationalTime->id);

            $scheduleExist = Schedule::where([["court_id", "=", $data['court_id']], ["operational_day_id", "=", $data["operational_day_id"]], ["operational_time_id", "=", $operationalTime->id]])->first();
            $data["is_active"] = $timeValue ? "1" : "0";
            $data["price"] = $price ? $price : "0";
            $data["operational_time_id"] =$operationalTime->id;

            if ($scheduleExist) {
                $scheduleExist->update($data);
            } else {
                Schedule::create($data);
            }
        }

        Alert::success('Sukses', 'Data berhasil ditambah.');

        return redirect("/admin/schedule/create?court_id=" . $data['court_id'] . "&operational_day_id=" . $data["operational_day_id"]);
    }
}