<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
            'account' => 'required_if:role,customer',
            'role' => 'required|string|in:super_admin,admin,customer',
            'password' => 'required|string|confirmed|min:8',
            'nik' => [
                'required_if:role,customer',
            ],
            'phone' => [
                'required_if:role,customer',
            ],
            'address' => [
                'required_if:role,customer',
            ],
            'internet_package_id' => [
                'required_if:role,customer',
            ],
        ]);

        User::create([
            'name' => $request->name,
            'account' => $request->account,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'nik' => $request->nik,
            'phone' => $request->phone,
            'address' => $request->address,
            'internet_package_id' => $request->package,
        ]);

        return redirect()->route('admin.users.create')->with(['success' => 'Berhasil Membuat User']);
    }

    public function edit(User $user): View
    {
        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        $user->update($request->all());
        return redirect()->route('admin.users.index')->with(['success' => 'Berhasil Mengedit User']);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with(['success' => 'Berhasil Menghapus User']);
    }

    public function show(User $user): View
    {
        return view('pages.admin.user.show', compact('user'));
    }
}
