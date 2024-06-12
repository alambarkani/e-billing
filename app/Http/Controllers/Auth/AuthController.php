<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view('pages.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'nik' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->internet_package_id = $request->internet_package_id;
        $user->save();
        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'account' => $request->account,
            'password' => $request->password,
        ];
        if (Auth::attempt($credetials)) {
            return redirect('/')->with('success', 'Login berhasil');
        }
        return back()->with('error', 'Email or Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
