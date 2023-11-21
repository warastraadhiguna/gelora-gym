<?php

namespace App\Http\Controllers;

use App\Models\Legal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LegalController extends Controller
{
    public function showLegal()
    {
        $data = [
            'title' => "Ubah Blog",
            'legal' => Legal::first(),
            'content' => "admin/legal/index"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function update(Request $request)
    {
        $legal = Legal::first();
        $data = $request->validate([
            'privacy_policy' => 'required',
            'return_refund_policy' => 'required',
            'terms_conditions' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        $legal->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/legal");
    }
}
