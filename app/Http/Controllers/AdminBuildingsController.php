<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Buildings;
use App\Models\User;


class AdminBuildingsController extends Controller
{
    public function AdminBuildings()
    {
        $buildings = Buildings::with('user')->get();
        return view('admin.admin-buildings', compact('buildings'));
    }

    public function getBuilding($id)
    {
        $building = Buildings::findOrFail($id);
        return response()->json($building);
    }

    public function addBuilding(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'address' => 'required|string|max:2048',
                'country' => 'required|string|max:255',
                'map' => 'required|string|max:2048',
                'user_id' => 'required|exists:users,id', // Xác minh user_id tồn tại
                'status' => 'required|in:waiting',
            ]);

            Buildings::create([
                'user_id' => $validatedData['user_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'country' => $validatedData['country'],
                'map' => $validatedData['map'],
                'status' => $validatedData['status'],
            ]);

            return redirect()->route('admin.buildings')->with('success', 'Building added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')->with('error', 'Failed to add building: ' . $e->getMessage());
        }
    }
}
