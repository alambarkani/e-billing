<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        try {
            Log::info('Register post request initiated', $request->all());

            $validatedData = $request->validate([
                'name' => 'required|max:50|string',
                'identity' => 'required',
                'email' => 'email|required',
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'internet_package_id' => 'required',
                'house_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'ktp_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            Log::info('Validation passed', $validatedData);
            Log::info('Files in request', [
                'house_image' => $request->file('house_image'),
                'ktp_image' => $request->file('ktp_image')
            ]);

            // Cek apakah file ada
            if (!$request->hasFile('house_image') || !$request->hasFile('ktp_image')) {
                return back()->withErrors(['error' => 'Both house image and KTP image are required.']);
            }

            $houseImg = $request->file('house_image');
            $ktpImg = $request->file('ktp_image');

            Log::info('Uploaded images', [
                'house_image' => $houseImg->getClientOriginalName(),
                'ktp_image' => $ktpImg->getClientOriginalName()
            ]);

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
            $customer->customer_id = $user->id;
            $customer->identity = $request->identity;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->internet_package_id = $request->internet_package_id;

            $houseImg->storeAs('public/images/', $customer->identity . '/' . $houseImgName);
            $ktpImg->storeAs('public/images/', $customer->identity . '/' . $ktpImgName);

            $customer->house_image_path = $houseImgName;
            $customer->ktp_image_path = $ktpImgName;
            $customer->save();

            Log::info('User saved successfully', ['user_id' => $user->id]);

            return back()->with('success', 'Register successfully');
        } catch (\Exception $e) {
            Log::error('An error occurred during registration', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'An error occurred during registration: ' . $e->getMessage()]);
        }
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
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
