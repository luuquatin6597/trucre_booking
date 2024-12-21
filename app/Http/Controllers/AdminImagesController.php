<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Images;
use File;
use Illuminate\Http\Request;

class AdminImagesController extends Controller
{
    public function uploadImage(Request $request, $id)
    {
        $room = Rooms::findOrFail($id);
        $images = Images::where('room_id', $room->id)->get();

        return view('admin.rooms.upoad-image', compact('room', 'images'));
    }

    public function storeImage(Request $request, $id)
    {
        try {
            $room = Rooms::findOrFail($id);
            $request->validate([
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $imageData = [];
            foreach ($request->file('images') as $key => $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '-' . $id . '-' . $key . '.' . $extention;
                $path = 'images/' . $filename;
                $file->move(public_path('images'), $filename);
                $imageData[] = [
                    'room_id' => $room->id,
                    'url' => $path
                ];
            }

            return Images::insert($imageData);
        } catch (\Exception $e) {
            return redirect()->route('admin.rooms')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function deleteImage(Request $request, $id)
    {
        $image = Images::findOrFail($id);
        if (File::exists(public_path($image->url))) {
            File::delete(public_path($image->url));
        }
        $image->delete();
        return redirect()->route('admin.rooms.upload', $image->room_id)
            ->with('success', 'Image deleted successfully!');
    }
}
