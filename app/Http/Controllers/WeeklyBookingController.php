<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Court;
use App\Models\Receipt;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\ReceiptDetail;
use App\Models\OperationalDay;
use Illuminate\Support\Facades\DB;
use App\Models\WeeklyBookingDetail;
use RealRashid\SweetAlert\Facades\Alert;

class WeeklyBookingController extends Controller
{
    public function index()
    {
        $bookings = Schedule::whereHas('weeklyBookingDetails')->orderby('operational_day_id', 'asc')->orderby('id', 'asc')->get();
        $court_id = Request()->input("court_id");
        $data =[
            'mondaySchedules' => $bookings->where('operational_day_id', '1')->where('court_id', $court_id),
            'tuesdaySchedules' => $bookings->where('operational_day_id', '2')->where('court_id', $court_id),
            'wednesdaySchedules' => $bookings->where('operational_day_id', '3')->where('court_id', $court_id),
            'thursdaySchedules' => $bookings->where('operational_day_id', '4')->where('court_id', $court_id),
            'fridaySchedules' => $bookings->where('operational_day_id', '5')->where('court_id', $court_id),
            'saturdaySchedules' => $bookings->where('operational_day_id', '6')->where('court_id', $court_id),
            'sundaySchedules' => $bookings->where('operational_day_id', '7')->where('court_id', $court_id),
            'courts' => Court::where("is_active", "=", "1")->get(),
            'title' => "Manajemen Data Booking Mingguan",
            'content' => "admin/weekly-booking/index",
            'court_id' => $court_id,
            'nowDayNumber' => \Carbon\Carbon::now()->dayOfWeek,
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
            'content' => "admin/weekly-booking/add",
            'schedules' => $operational_day_id ? Schedule::where([["court_id", $court_id],["operational_day_id", $operational_day_id]])->doesntHave('weeklyBookingDetails')->orderBy("operational_time_id", "asc")->get() : null,
            'operationalDays' => OperationalDay::orderBy("index", "ASC")->get(),
            'users' => User::where([["role", "user"], ['is_active', 'y']])->get(),
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
            'user_id' => 'required',
        ]);
        $data['updated_user_id'] = auth()->user()->id;
        $court_id = $data['court_id'];
        $schedules = Schedule::where([["court_id", $data['court_id']],["operational_day_id", $data["operational_day_id"]]])->doesntHave('weeklyBookingDetails')->orderBy("operational_time_id", "asc")->get();

        unset($data['operational_day_id']);
        unset($data['court_id']);
        $warningInformation = "";
        foreach ($schedules as $schedule) {
            $timeValue = Request()->input("time_" . $schedule->id);
            if($timeValue) {

                $nowTime = \Carbon\Carbon::now();
                $receiptDetailExist = ReceiptDetail::where([['schedule_id', '=', $schedule->id], ['booking_date', '>=', DateFormat($nowTime, 'Y-MM-DD')]])->first();

                if($receiptDetailExist) {
                    $warningInformation =  $warningInformation . $schedule->operationalTime->name . "(" . DateFormat($receiptDetailExist->booking_date, "DD MMMM Y") . "); ";
                } else {
                    $data['schedule_id'] = $schedule->id;
                    WeeklyBookingDetail::create($data);
                }
            }
        }

        if($warningInformation) {
            Alert::warning('Peringatan', 'Sebagian data berhasil ditambah. Tapi data ' . $warningInformation .  ' sudah dibooking orang lain.');

        } else {
            Alert::success('Sukses', 'Data berhasil ditambah.');
        }

        return redirect("/admin/weekly-booking?court_id=" . $court_id);
    }

    public function addReceipt(Request $request)
    {
        $data = $request->validate([
            'court_id' => 'required',
            'operational_day_id' => 'required',
            'user_id' => 'required',
        ]);
        $courtId = $data['court_id'];

        try {

            DB::beginTransaction();

            $nowTime = \Carbon\Carbon::now();

            $bookings = Schedule::whereHas('weeklyBookingDetails')->where([['operational_day_id', $data['operational_day_id']], ['court_id', $data['court_id']]])->get();

            $user = User::find($data['user_id']);
            $data['updated_user_id'] = auth()->user()->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $data['note'] = "Booking Mingguan";
            $data['number'] = GetNumber("R/" . DateFormat($nowTime, "Y/M/"), Receipt::whereYear('created_at', '=', DateFormat($nowTime, "Y"))
            ->whereMonth('created_at', '=', DateFormat($nowTime, "M"))->get());
            unset($data['court_id']);
            unset($data['operational_day_id']);
            $newReceipt = Receipt::create($data);

            $insertedData = array();
            $i = 0;

            foreach ($bookings as $booking) {
                if($booking->weeklyBookingDetails[0]->user_id == $data['user_id']) {
                    $insertedData[$i] = [
                        'receipt_id' => $newReceipt->id,
                        'schedule_id' => $booking->id,
                        'booking_date' => DateFormat($nowTime, "Y/M/D"),
                        'price' => $booking->court->price
                    ];

                    $i++;
                }
            }

            ReceiptDetail::insert($insertedData);
            DB::commit();
            Alert::success('Sukses', 'Data berhasil ditambah.');

            return redirect("admin/receipt");
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Error', $e->getMessage());
            return redirect("admin/weekly-booking?court_id=" . $courtId);
        }
    }

    public function destroy($id)
    {
        $weeklyBookingDetail = WeeklyBookingDetail::find($id);

        try {
            $weeklyBookingDetail->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        } catch(\Throwable $e) {
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect("/admin/weekly-booking?court_id=" . $weeklyBookingDetail->schedule->court_id);
        }
    }
}