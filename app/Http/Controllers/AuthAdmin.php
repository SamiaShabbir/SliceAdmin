<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Api\User;
use Alert;

class AuthAdmin extends Controller
{
    public function loginpage()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $get = Auth::user();
            if ($get) {
                $check = $get->role;
                if ($check == "admin") {
                    $request->session()->regenerate();

                    return redirect('/');
                } else {
                    Alert::error('Error', 'Wrong Credidentials');
                    return back();
                }
            } else {
                Alert::error('Error', 'Wrong Credidentials');
                return back();
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/pizza-admin/login');
    }
}
