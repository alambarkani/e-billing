<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    public function index(Request $request): View
    {
        if ($request->keyword) {
            $admins = Admin::search($request->keyword)
                ->latest()
                ->paginate(10);
            $admins->appends($request->all());
        } else {
            $admins = Admin::latest()
                ->paginate(10);
        }

        return view('pages.admin.user.index', compact('admins'));
    }

    public function create(): View
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string|same:password',
            'authorize' => 'required|string|in:super-admin,admin',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->authorize = $request->authorize;
        $admin->save();

        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->userable()->associate($admin);
        $user->save();

        return redirect()->route('super-admin.users.index')->with(['success' => 'Berhasil Membuat User']);
    }

    public function edit(Admin $user): View
    {
        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(Admin $user, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->user->id,
            'username' => 'required|unique:users,username,' . $user->user->id,
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string|same:password',
            'authorize' => 'required|string|in:super-admin,admin',
        ]);

        $userable = $user->user;
        $userable->username = $request->username;
        $userable->email = $request->email;
        $userable->password = bcrypt($request->password);
        $userable->save();

        $user->name = $request->name;
        $user->authorize = $request->authorize;
        $user->save();

        return redirect()->route('super-admin.users.index')->with(['success' => 'Berhasil Mengedit User']);
    }

    public function destroy(Admin $user): RedirectResponse
    {
        if ($user->user && Auth::user()->id === $user->user->id) {
            return redirect()->route('super-admin.users.index')->with(['errors' => 'Gagal Menghapus Akun Sendiri']);
        }

        $user->user()->delete();
        $user->delete();
        return redirect()->route('super-admin.users.index')->with('success', 'Berhasil Menghapus '. $user->name);
    }

    public function show(Admin $user): View
    {
        return view('pages.admin.user.show', compact('user'));
    }
}
