<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

     public function handleGoogleCallback()
     {
         try {
             $user = Socialite::driver('google')->user();

             $finduser = User::where('google_id', $user->id)->first();
             if($finduser) {
                 Auth::login($finduser);
                 Request()->session()->regenerate();

                 return redirect()->intended('admin/dashboard');

             } else {
                 $newUser = User::create([
                     'username' => $user->name,
                     'name' => $user->name,
                     'email' => $user->email,
                     'google_id'=> $user->id,
                     'password' => Hash::make("pada hari minggu kuturut ayah ke kota naik delman")
                 ]);

                 Auth::login($newUser);

                 return redirect()->intended('admin/dashboard');
             }

         } catch (Exception $e) {
             dd("error : " . $e->getMessage());
         }
     }
}