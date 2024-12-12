<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;


class AdminRoomsController extends Controller
{
    public function AdminRooms()
    {
        $rooms = Rooms::all();
        return view('admin.admin-rooms')->with('rooms', $rooms);
    }
}
