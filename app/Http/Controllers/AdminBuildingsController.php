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
                'map_link' => 'required|url|max:2048',
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:waiting',
            ]);

            $building = Buildings::create([
                'user_id' => $validatedData['user_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'country' => $validatedData['country'],
                'map_link' => $validatedData['map_link'],
                'status' => $validatedData['status']
            ]);

            if ($request->hasFile('certificates')) {
                $certificateController = new AdminCertificatesController();
                $certificateController->storeCertificate($request, $building->id);
            }

            return redirect()->route('admin.buildings')->with('success', 'Building added successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('admin.buildings')->with('error', 'Failed to add building: ' . $e->getMessage());
        }

    }



  public function updateBuilding(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'address' => 'required|string|max:2048',
                'country' => 'required|string|max:255',
                'map_link' => 'required|url|max:2048',
                'status' => 'required|in:waiting,active,inactive',
            ]);

            $building = Buildings::findOrFail($id);
            $building->name = $validatedData['name'];
            $building->description = $validatedData['description'];
            $building->address = $validatedData['address'];
            $building->country = $validatedData['country'];
            $building->map_link = $validatedData['map_link'];
            $building->status = $validatedData['status'];
            $building->save();
            return redirect()->route('admin.buildings')->with('success', 'Building updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')->with('error', 'Failed to update building: ' . $e->getMessage());
        }
    }
    public function deleteBuilding($id)
    {
        try {
            $building = Buildings::findOrFail($id);
            if ($building->status == 'active') {
                $building->status = 'inactive';
                $building->save();
            }
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')->with('error', 'Failed to delete building: ' . $e->getMessage());
        }
    }
}
