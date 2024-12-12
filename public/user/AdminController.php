<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function AdminUsers()
    {
        $users = User::all();
        return view('admin.admin-users')->with('users', $users);
    }
    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'dayOfBirth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'role' => 'required|in:admin,user,staff,owner',
            'status' => 'required|in:active,inactive',
        ]);

        User::create([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'dayOfBirth' => $validatedData['dayOfBirth'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'country' => $validatedData['country'],
            'username' => $validatedData['username'],
            'role' => $validatedData['role'],
            'status' => $validatedData['status'],
            'password' => bcrypt('default_password'),
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully.');
    }

    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'dayOfBirth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'role' => 'required|in:admin,user,staff,owner',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
function deleteUser($id)
{
    $user = User::findOrFail($id);
     if ($user->status == 'active') {
        $user->status = 'inactive';
        $user->save();
    }
    return redirect()->route('admin.users')->with('success', 'User deleted successfully.');

}

public function AdminTypeAccount()
{
    $users = User::all()->groupBy('role');
    return view('admin.admin-typeaccount', compact('users'));
}

public function index()
{
    $buildings = Building::all();
    return view('admin.buildings.index', compact('buildings'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'map' => 'required|string|max:255',
    ]);

    Building::create($validatedData);
    return redirect()->route('admin.buildings')->with('success', 'Tòa nhà đã được thêm thành công!');

}

public function edit($id)
{
    $building = Building::find($id);
    return view('admin.edit-building', compact('building'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'map' => 'required|string|max:255',
    ]);

    $building = Building::find($id);
    $building->update($validatedData);

    return redirect()->route('admin.building.index')->with('success', 'Tòa nhà đã được cập nhật thành công!');
}

public function destroy($id)
{
    $building = Building::find($id);
    $building->delete();

    return redirect()->route('admin.building.index')->with('success', 'Tòa nhà đã được xóa thành công!');
}
}
