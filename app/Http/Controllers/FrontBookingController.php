<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Rooms;
use Arr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontBookingController extends Controller
{
    public function viewBooking(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|integer',
            'frequency' => 'required|in:All day,Session',
            'bookingType' => 'required|in:All day,Session',
            'sessionType' => 'nullable|in:All day,Morning,Afternoon,Evening',
            'startAt' => 'required|date_format:m/d/Y',
            'endAt' => 'required|date_format:m/d/Y',
        ]);

        $params = Arr::except($validatedData, ['_token']);
        $room = Rooms::findOrFail($params['room_id']);

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

        return view('booking.view', compact('room', 'params', 'allBookedDates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'startAt' => 'required|date_format:m/d/Y',
            'endAt' => 'required|date_format:m/d/Y',
            'frequency' => 'required|in:All_day,Session',
        ]);
        session(['booking_info' => $request->all()]);
        session(['booking_total' => $request->total]);
        return redirect()->route('vnpay.prepare', ['total' => $request->total, 'code' => $request->room_id]);
    }

    public function prepare(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'startAt' => 'required|date_format:m/d/Y',
            'endAt' => 'required|date_format:m/d/Y',
            'frequency' => 'required|in:All_day,Session',
        ]);

        $params = $request->all();
        return redirect()->route('booking.view', $params);
    }
}