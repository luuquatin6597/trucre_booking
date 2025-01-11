<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontRoomController extends Controller
{
    function getRoom($id)
    {
        $room = Rooms::findOrFail($id);

        //dd($room);

        $bookedDates = Bookings::where('room_id', $room->id)
            ->whereDate('startAt', '>=', date('Y-m-d'))
            ->select(
                'startAt',
                'endAt',
                'bookingType',
                'sessionType'
            )
            ->get()
            ->toArray();

        $allBookedDates = [];
        foreach ($bookedDates as $booking) {
            $start = Carbon::parse($booking['startAt']);
            $end = Carbon::parse($booking['endAt']);

            for ($date = $start; $date->lte($end); $date->addDay()) {
                $allBookedDates[] = $date->toDateString();
            }
        }

        //dd($allBookedDates);

        return view('room.room', compact('room', 'allBookedDates'));
    }
}