<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receipt;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $nowTime = \Carbon\Carbon::now();

        $data =[
            'title' => "Dashboard",
            'booking' =>  Receipt::where("status", "1")->count(),
            'user' => User::where("role", "user")->count(),
            'content' => "admin/dashboard/index",
            'nowTime' => $nowTime
        ];

        return view('admin.layouts.wrapper', $data);
    }
}