<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Buildings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBookingsController extends Controller
{
    public function AdminBooking()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $bookings = Bookings::with(['user', 'room'])->get();
        } elseif ($user->role === 'owner') {
            $buildingIds = Buildings::where('user_id', $user->id)->pluck('id');
            $roomIds = \App\Models\Rooms::whereIn('building_id', $buildingIds)->pluck('id');
            $bookings = Bookings::with(['user', 'room'])
                ->whereIn('room_id', $roomIds)
                ->get();
        } else {
            $bookings = collect();
        }

        return view('admin.admin-bookings', compact('bookings'));
    }

    public function getBooking($id)
    {
        $user = Auth::user();
        $query = Bookings::with(['user', 'room'])->where('id', $id);

        if ($user->role === 'owner') {
            $buildingIds = Buildings::where('user_id', $user->id)->pluck('id');
            $roomIds = \App\Models\Rooms::whereIn('building_id', $buildingIds)->pluck('id');
            $query->whereIn('room_id', $roomIds);
        }

        $booking = $query->firstOrFail();

        $profit = $this->calculateProfit($id);

        return view('admin.bookings.booking-detail', compact('booking', 'profit'));
    }

    public function calculateProfit($bookingId)
    {
        // Lấy thông tin booking theo ID
        $booking = Bookings::find($bookingId);

        // Tính toán lợi nhuận và tiền hoa hồng
        if ($booking) {
            $totalPrice = $booking->totalPrice;
            $tax = $booking->tax;
            $priceAfterTax = $totalPrice - $tax;

            // Tính tiền hoa hồng 5% của sàn
            $commission = $priceAfterTax * 0.05;

            // Tính lợi nhuận
            $profit = $priceAfterTax - $commission;

            return ['commission' => $commission, 'profit' => $profit];
        }

        return redirect()->back()->with('error', 'Booking not found!');
    }
}
