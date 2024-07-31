<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\InternetPackage;

class AuthController extends Controller
{
    //
    public function register()
    {
        $pkgs = InternetPackage::all();
        return view('pages.register', compact('pkgs'));
    }

    public function registerPost(Request $request)
    {

        $request->validate([
            'name' => 'required|max:50|string',
            'identity' => 'required',
            'email' => 'email|required|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'internet_package_id' => 'required',
            'house_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'ktp_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Cek apakah file ada
        if (!$request->hasFile('house_image') || !$request->hasFile('ktp_image')) {
            return back()->withErrors(['error' => 'Both house image and KTP image are required.']);
        }

        $houseImg = $request->file('house_image');
        $ktpImg = $request->file('ktp_image');

        $houseImgName = 'house_' . time() . '.' . $houseImg->getClientOriginalExtension();
        $ktpImgName = 'ktp_' . time() . '.' . $ktpImg->getClientOriginalExtension();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        do {
            $randomInt = random_int(1000, 9999);
            $exists = User::where('account', $randomInt)->exists();
        } while ($exists);
        $user->account = (string)$randomInt;
        $user->password = (string)random_int(1000, 9999);
        $user->save();

        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->identity = $request->identity;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->internet_package_id = $request->internet_package_id;

        $houseImg->storeAs('public/images/', $customer->identity . '/' . $houseImgName);
        $ktpImg->storeAs('public/images/', $customer->identity . '/' . $ktpImgName);

        $customer->house_image_path = $houseImgName;
        $customer->ktp_image_path = $ktpImgName;
        $customer->save();


        return redirect()->back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'account' => $request->account,
            'password' => $request->password,
        ];

        // Cari user berdasarkan account
        $user = User::where('account', $credentials['account'])->first();

        // Cek jika user ditemukan dan password cocok
        if ($user && $user->password === $credentials['password']) {
            Auth::login($user);
            return redirect('/')->with('success', 'Login berhasil');
            if ($user->role == "customer") {
                return redirect('/');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }


        return back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
