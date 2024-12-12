<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    function index() {
        return view('homepage.homepage');
    }
}
