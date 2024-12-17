<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Building;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function Bview()
    {
        $buildings = Building::all();
        return view('admin.owner-buildings', compact('buildings'));
    }

}
