<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user yang sudah terdaftar.
     */
    public function index(): View
    {
        $users = User::where('role', 'user')
            ->latest()
            ->get();

        return view('admin.users.index', compact('users'));
    }
}