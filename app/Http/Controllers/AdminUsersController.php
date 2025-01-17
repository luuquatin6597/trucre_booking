<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Database\Eloquent\Model;

class AdminUsersController extends Controller
{
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
            'password' => 'required|string|min:8',
        ]);

        try {
            $user = User::create([
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
                'password' => Hash::make($validatedData['password']),
            ]);


            return redirect()->route('admin.users')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Failed to add user: ' . $e->getMessage());
        }
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'dayOfBirth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username,' . $id,
                'role' => 'required|in:admin,user,staff,owner',
                'status' => 'required|in:active,inactive',
                'password' => 'nullable|string|min:8',
            ]);


            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($request->password);
            }

            $user = User::findOrFail($id);
            $user->fill($validatedData)->save();

            return redirect()->route('admin.users')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {

            return redirect()->route('admin.users')->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }


    function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->status == 'active') {
                $user->status = 'inactive';
                $user->save();
            }
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }

    public function AdminTypeAccount()
    {
        $users = User::all()->groupBy('role');
        return view('admin.admin-typeaccount', compact('users'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');

    }
}
