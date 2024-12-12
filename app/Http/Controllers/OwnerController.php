<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function OwnerDashboard()
    {
        return view('owner.owner-dashboard');
    }
}
