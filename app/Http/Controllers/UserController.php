<?php

namespace App\Http\Controllers;

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
}
