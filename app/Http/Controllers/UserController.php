<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('pages.admin.user.index', compact('users'));
    }

    public function create(): View
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'account' => 'required|string',
            'role' => 'required|string|in:super_admin,admin,customer',
            'password' => 'required|string',
            'nik' => [
                'required_if:role,customer',
                'numeric'
            ],
            'phone' => [
                'required_if:role,customer',
                'numeric'
            ],
            'address' => [
                'required_if:role,customer',
                'string'
            ],
            'internet_package_id' => [
                'required_if:role,customer',
                'numeric'
            ],
        ]);

        $user = User::create([
            'account' => $request->account,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        if ($request->role === 'customer') {
            Customer::create([
                'id' => $user->id,
                'name' => $request->name,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
                'internet_package_id' => $request->internet_package_id
            ]);
        } else if ($request->role === 'admin' || $request->role === 'super_admin') {
            Admin::create([
                'id' => $user->id,
                'name' => $request->name,
            ]);
        }
    }
}
