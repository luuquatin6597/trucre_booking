<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Buildings;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Rooms;


class AdminRoomsController extends Controller
{
    public function AdminRooms()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $rooms = Rooms::with('building')->get();
        } elseif ($user->role === 'owner') {
            $buildings = Buildings::where('user_id', $user->id)->pluck('id');
            $rooms = Rooms::with('building')->whereIn('building_id', $buildings)->get();
        } else {
            $rooms = collect();
        }

        return view('admin.admin-rooms')->with('rooms', $rooms);
    }

    public function getRoom($id)
    {
        $user = Auth::user();
        $room = Rooms::findOrFail($id);

        if ($user->role === 'owner' && $room->building->user_id !== $user->id) {
            abort(403, 'Unauthorized access to this room.');
        }

        $bookings = Bookings::where('room_id', $room->id)->get();

        $events = [];
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->startAt);
            $end = Carbon::parse($booking->endAt);
            $bookingType = $booking->bookingType;
            $sessionType = $booking->sessionType;

            $booking = Bookings::where('status', 'approved') // Thêm điều kiện where status = 'approved'
                ->first();

            if (!$booking) {
                continue; // Bỏ qua nếu không có booking nào approved
            }

            if ($bookingType === 'All day') {
                $events[] = [
                    'start' => $start->format('Y-m-d') . 'T08:00:00',
                    'end' => $end->format('Y-m-d') . 'T22:00:00',
                    'title' => $room->name,
                    'backgroundColor' => 'rgba(1,104,250, .5)',
                    'borderColor' => '#0168fa',
                    'userName' => $booking->userName,
                    'userEmail' => $booking->userEmail,
                    'userPhone' => $booking->userPhone,
                    'transaction_payment_method' => $booking->payment_method,
                    'transaction_totalPrice' => $booking->totalPrice,
                ];
            }
            if ($bookingType === 'Session' && $sessionType === 'Morning') {
                $events[] = [
                    'start' => $start->format('Y-m-d') . 'T08:00:00',
                    'end' => $end->format('Y-m-d') . 'T12:00:00',
                    'title' => $room->name,
                    'backgroundColor' => 'rgba(16,183,89, .5)',
                    'borderColor' => '#10b759',
                    'userName' => $booking->userName,
                    'userEmail' => $booking->userEmail,
                    'userPhone' => $booking->userPhone,
                    'transaction_payment_method' => $booking->payment_method,
                    'transaction_totalPrice' => $booking->totalPrice,
                ];
            }
            if ($bookingType === 'Session' && $sessionType === 'Afternoon') {
                $events[] = [
                    'start' => $start->format('Y-m-d') . 'T13:00:00',
                    'end' => $end->format('Y-m-d') . 'T17:00:00',
                    'title' => $room->name,
                    'backgroundColor' => 'rgba(241,0,117,.5)',
                    'borderColor' => '#f10075',
                    'userName' => $booking->userName,
                    'userEmail' => $booking->userEmail,
                    'userPhone' => $booking->userPhone,
                    'transaction_payment_method' => $booking->payment_method,
                    'transaction_totalPrice' => $booking->totalPrice,
                ];
            }
            if ($bookingType === 'Session' && $sessionType === 'Evening') {
                $events[] = [
                    'start' => $start->format('Y-m-d') . 'T18:00:00',
                    'end' => $end->format('Y-m-d') . 'T22:00:00',
                    'title' => $room->name,
                    'backgroundColor' => 'rgba(0,204,204,.5)',
                    'borderColor' => '#00cccc',
                    'userName' => $booking->userName,
                    'userEmail' => $booking->userEmail,
                    'userPhone' => $booking->userPhone,
                    'transaction_payment_method' => $booking->payment_method,
                    'transaction_totalPrice' => $booking->totalPrice,
                ];
            }
        }


        return view('admin.rooms.room-detail', compact('room', 'events'));
    }

    public function addRoom(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'comparePrice' => 'required|numeric',
                'description' => 'required|string|max:2048',
                'maxChair' => 'required|numeric',
                'maxTable' => 'required|numeric',
                'maxPeople' => 'required|numeric',
                'tags' => 'required|string|max:2048',
                'furniture' => 'required|string|max:2048',
                'startAt' => 'required|date',
                'endAt' => 'required|date',
                'building_id' => 'required|exists:buildings,id',
                'status' => 'required|in:waiting',
                'allDayPrice' => 'required|numeric',
                'sessionPrice' => 'required|numeric',
                'type' => 'required|in:Meeting room,Conference room',
            ]);

            $room = Rooms::create($validatedData);

            if ($request->hasFile('images')) {
                $imageController = new AdminImagesController();
                $imageController->storeImage($request, $room->id);
            }

            return redirect()->route('admin.rooms')->with('success', 'Room added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.rooms')->with('error', 'Failed to add room: ' . $e->getMessage());
        }
    }
}
