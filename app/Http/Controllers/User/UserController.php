<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
            $users = User::search($request->keyword)->where('role', 'admin', 'super_admin')
                ->latest()
                ->paginate(5);
        } else {
            $users = User::where('role', 'admin')->orWhere('role', 'super_admin')
                ->latest()
                ->paginate(5);
        }

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
            'account' => 'required|unique:users,account',
            'role' => 'required|string|in:super_admin,admin,customer',
            'password' => 'required|string|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'account' => $request->account,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.create')->with(['success' => 'Berhasil Membuat User']);
    }

    public function edit(User $user): View
    {
        if (Auth::user()->role != 'super_admin') {
            return redirect()->route('admin.users.index')->with(['error' => 'Tidak Bisa Mengedit Super Admin']);
        }
        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'account' => 'required|unique:users,account,' . $user->id,
            'role' => 'required|string|in:super_admin,admin,customer',
        ]);

        $user->update($request->all());
        return redirect()->route('admin.users.index')->with(['success' => 'Berhasil Mengedit User']);
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('admin.users.index')->with(['error' => 'Tidak bisa menghapus akun sendiri']);
        } else if ($user->role == 'super_admin') {
            return redirect()->route('admin.users.index')->with(['error' => 'Tidak bisa menghapus super admin']);
        } else {
            $user->delete();
            return redirect()->route('admin.users.index')->with(['success' => 'Berhasil Menghapus User']);
        }
    }

    public function show(User $user): View
    {
        return view('pages.admin.user.show', compact('user'));
    }
}
