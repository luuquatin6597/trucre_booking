<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function OwnerDashboard()
    {
        return view('owner.owner-dashboard');
    }

    public function autocomplete(Request $request)
    {
        $term = $request->get('term');
        $users = User::where('role', 'owner')
            ->where(function ($query) use ($term) {
                $query->where('firstName', 'LIKE', '%' . $term . '%')
                    ->orWhere('lastName', 'LIKE', '%' . $term . '%');
            })
            ->select('id', DB::raw("CONCAT(firstName, ' ', lastName) as name"))
            ->get();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
            ];
        }
        return response()->json($data);
    }
}
