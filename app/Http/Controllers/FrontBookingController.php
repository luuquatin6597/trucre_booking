<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Rooms;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontBookingController extends Controller
{
    public function viewBooking(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|integer',
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

    public function paymentMethod(Request $request)
    {
        try {
            if (!Auth::check()) {
                Session::put('booking_params', $request->all());
                Session::put('redirect_to', route('booking.view'));
                return redirect()->route('login');
            }

            $bookingInfo = $request->all();

            if ($bookingInfo['payment_method'] === 'vnpay') {
                $bookingInfo['price'] = $bookingInfo['price'] * getExchangeRate(session('currency'), env('VNPAY_CURRENCY'));
                $bookingInfo['totalPrice'] = $bookingInfo['totalPrice'] * getExchangeRate(session('currency'), env('VNPAY_CURRENCY'));
                $bookingInfo['tax'] = $bookingInfo['tax'] * getExchangeRate(session('currency'), env('VNPAY_CURRENCY'));

                return redirect()->route('payment.vnpay', $bookingInfo);

            } elseif ($bookingInfo['payment_method'] === 'paypal') {
                $bookingInfo['price'] = $bookingInfo['price'] * getExchangeRate(session('currency'), env('PAYPAL_CURRENCY'));
                $bookingInfo['totalPrice'] = $bookingInfo['totalPrice'] * getExchangeRate(session('currency'), env('PAYPAL_CURRENCY'));
                $bookingInfo['tax'] = $bookingInfo['tax'] * getExchangeRate(session('currency'), env('PAYPAL_CURRENCY'));

                return redirect()->route('payment.paypal', $bookingInfo);

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}