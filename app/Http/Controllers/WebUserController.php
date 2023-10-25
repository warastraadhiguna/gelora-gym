<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WebUserController extends Controller
{
    public function index()
    {
        $limit = 10;
        $page = Request()->input("page");
        $page = $page ? $page : 1;

        $data = [
            'content' => "main/user/dashboard",
            'receipts' => Receipt::with('receiptDetails')->where("user_id", auth()->user()->id)->limit($limit * $page)->orderby('created_at', 'desc')->get(),
            'page' => $page,
            'limit' => $limit
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function profile()
    {
        $data = [
            'content' => "main/user/profile",
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $data = $request->validate([
            'username' => 'required|unique:users,username,' . auth()->user()->id,
            'name' => 'required',
            'email' => 'sometimes',
            'phone' => 'required|numeric',
            'image_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if($request->hasFile('image_url')) {
            if($user->image_url != null) {
                Storage::delete($user->image_url);
            }

            $data['image_url'] = $request->file("image_url")->store('img');
        } else {
            $data['image_url'] =  $user->image_url;
        }

        $user->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/profile");
    }

    public function password()
    {
        $data = [
            'content' => "main/user/password",
        ];

        return view("main.layouts.wrapper", $data);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $data = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|min:1',
            'repassword' => 'required|min:1|same:password',
        ]);

        if (Hash::check($data['oldPassword'], $user->password)) {
            $data['password'] = Hash::make($data['password']);
            $user->update($data);
            Alert::success('Sukses', 'Data berhasil diupdate.');
        } else {
            Alert::error('Error', 'Password lama salah!!');
        }

        return redirect("/password");
    }
}
