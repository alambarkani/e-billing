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
            'identity' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'internet_package_id' => 'required',
            'house_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'ktp_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $houseImg = $request->file('house_image');
        $ktpImg = $request->file('ktp_image');

        $houseImgName = 'house_' . time() . '.' . $houseImg->getClientOriginalExtension();
        $ktpImgName = 'ktp_' . time() . '.' . $ktpImg->getClientOriginalExtension();


        $user = new User();
        $user->name = $request->name;
        do {
            $randomInt = random_int(1000, 9999);
            $exists = User::where('account', $randomInt)->exists();
        } while ($exists);
        $user->account = $randomInt;
        $user->password = random_int(1000, 9999);
        $user->identity = $request->identity;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->internet_package_id = $request->internet_package_id;

        $houseImg->storeAs('public/images/', $user->identity . '/' . $houseImgName);
        $ktpImg->storeAs('public/images/', $user->identity . '/' . $ktpImgName);

        $user->house_image_path = $houseImgName;
        $user->ktp_image_path = $ktpImgName;
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
