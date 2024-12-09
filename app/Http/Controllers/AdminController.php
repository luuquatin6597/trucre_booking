<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function AdminUsers()
    {
        $users = User::all();
        return view('admin.admin-users')->with('users', $users);
    }
}
