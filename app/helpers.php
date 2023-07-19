<?php

use Illuminate\Support\Facades\URL;

function DateFormat($date, $format)
{
    return \Carbon\Carbon::parse($date)->isoFormat($format);
}

function DateConvert($date)
{
    return \Carbon\Carbon::parse($date);
}

function NumberFormat($number)
{
    return number_format($number, 0, ',', '.');
}

function IsActive($value)
{
    return $value === "1" ? "Aktif" : "Non Aktif";
}

function GetNumber($header, $data)
{
    $result = "";
    $index = 1;
    $counterString = "";
    while(true) {
        $indexString = strval($index);
        $counterString = "";

        for ($i=5; $i > strlen($indexString); $i--) {
            $counterString = $counterString . "0";
        }
        $result = $header . $counterString . $indexString;

        $numberExists = $data->where("number", $result);
        if (count($numberExists) == 0) {
            break;
        }

        $index++;

        if($index === 1000) {
            break;
        }
    }

    return $result;
}

function GetPhotoProfile()
{
    return auth()->user()->image_url ? URL::to('/storage') . "/" . auth()->user()->image_url : URL::to('/img/user.png');
}

function GetTimes()
{
    // '00:00', '01:00', '02:00', '03:00','04:00', '05:00',
    return ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'];
}

function GetCourtQuantity()
{
    return ['1', '2', '3', '4'];
}

function GetRepeatedDays()
{
    return [
        ['1', '1 Hari'],
        ['7', 'Setiap Minggu (setiap 7 hari)'],
        ['28', 'Setiap Bulan (setiap 28 hari)'],
    ];
}

function GetRepeatedPeriods()
{
    return [
        ['0', 'Tidak Berulang'],
        ['1', '2 kali'],
        ['2', '3 kali'],
        ['3', '4 kali'],
        ['4', '5 kali'],
        ['5', '6 kali'],
        ['6', '7 kali'],
        ['7', '8 kali'],
        ['8', '9 kali'],
        ['9', '10 kali'],
    ];
}

function GetScheduleFilter()
{
    $filter = array();
    $type_id = Request()->input("type_id");
    $date = Request()->input("date");
    $start_time = Request()->input("start_time");
    $end_time = Request()->input("end_time");
    $court_quantity = Request()->input("court_quantity");

    if(!$date) {
        $start_time = "";
        $end_time ="";
    }

    if(!$start_time && $end_time) {
        $start_time = $end_time;
    }

    if(!$end_time && $start_time) {
        $end_time = $start_time;
    }

    $filter[0] = $type_id;
    $filter[1] = $date;
    $filter[2] = $start_time;
    $filter[3] = $end_time;
    $filter[4] = (int)($court_quantity ? $court_quantity : 1);

    return $filter;
}