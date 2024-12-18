<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Buildings;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function Bview()
    {
        $buildings = Buildings::all();
        return view('admin.owner-buildings', compact('buildings'));
    }

}
