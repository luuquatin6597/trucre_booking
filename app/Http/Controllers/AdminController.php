<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Building;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function Bview()
    {
        $buildings = Building::all();
        return view('admin.owner-buildings', compact('buildings'));
    }
    public function addBuilding(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:2048',
            'status' => 'required|in:waiting',
        ]);

        Building::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'address' => $validatedData['address'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('admin.owner-buildings')->with('success', 'Building added successfully.');
    }

}
