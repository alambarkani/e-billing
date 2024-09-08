<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Installation;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Random\RandomException;

class RegisterController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('pages.auth.register', compact('products'));
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'identity' => 'required',
            'email' => 'email|required|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'product' => 'required',
            'location_image_path' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'identity_image_path' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        // Cek file
        if (!$request->hasFile('location_image_path') || !$request->hasFile('identity_image_path')) {
            return back()->withErrors(['errors' => 'Both location image and Identity image are required.']);
        }

        $locationImg = $request->file('location_image_path');
        $identityImg = $request->file('identity_image_path');

        $locationImgName = 'location_' . time() . '.' . $locationImg->getClientOriginalExtension();
        $identityImgName = 'identity_' . time() . '.' . $identityImg->getClientOriginalExtension();


        $customer = new Customer();
        $customer->name = $request->name;
        $customer->identity = $request->identity;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->identity_image_path = $customer->identity . '/' . $identityImgName;
        $customer->location_image_path = $customer->identity . '/' . $locationImgName;
        $customer->product()->associate($request->product);
        $customer->save();

        $locationImg->storeAs('public/images/', $customer->identity . '/' . $locationImgName);
        $identityImg->storeAs('public/images/', $customer->identity . '/' . $identityImgName);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->userable()->associate($customer);
        $user->save();

        $sendNotif = Notification::where('type', 'register')->first();
        sendWhatsappMessage($customer->phone, $sendNotif->message, $sendNotif->token);
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
