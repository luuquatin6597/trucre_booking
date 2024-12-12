<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    function ViewRooms(){
        return view('admin.admin-listrooms');
    }
}
