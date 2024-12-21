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

    public function getRoom($id)
    {
        $room = Rooms::findOrFail($id);
        return view('admin.admin-rooms')->with('room', $room);
    }

    public function addRoom(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'comparePrice' => 'required|numeric',
                'weekPrice' => 'required|numeric',
                'monthPrice' => 'required|numeric',
                'yearPrice' => 'required|numeric',
                'weekendPrice' => 'required|numeric',
                'holidayPrice' => 'required|numeric',
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
