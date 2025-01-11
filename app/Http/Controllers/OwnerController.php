<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Buildings;
use App\Models\Bookings;
use App\Models\Rooms;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function OwnerDashboard()
    {
        $user = Auth::user();
        $role = $user->role;

        $totalBookings = Bookings::when($role === 'owner', function ($query) use ($user) {
            $query->whereHas('room.building', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->count();


        $totalRevenue = Bookings::when($role === 'owner', function ($query) use ($user) {
            $query->whereHas('room.building', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->sum('totalPrice');

        $totalRooms = Rooms::when($role === 'owner', function ($query) use ($user) {
            $query->whereHas('building', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->count();

        $totalBuildings = Buildings::when($role === 'owner', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Revenue Chart Data
        $revenueData = $this->getRevenueData('month', $role, $user);
        $revenueChartData = $revenueData['data'];
        $revenueChartCategories = $revenueData['categories'];
        $selectedPeriod = 'month'; // Mặc định là tháng

        // Monthly Booking Chart Data
        $monthlyBookingData = $this->getMonthlyBookingData($role, $user);
        $monthlyBookingChartData = $monthlyBookingData['data'];
        $monthlyBookingChartCategories = $monthlyBookingData['categories'];

        // User & Owner Count Data
        $userOwnerCounts = $this->getUserOwnerCounts();
        $userCount = $userOwnerCounts['userCount'];
        $ownerCount = $userOwnerCounts['ownerCount'];

        return view('owner.owner-dashboard', compact('totalBookings', 'totalRevenue', 'totalRooms', 'totalBuildings', 'revenueChartData', 'revenueChartCategories', 'selectedPeriod', 'monthlyBookingChartData', 'monthlyBookingChartCategories', 'userCount', 'ownerCount', 'role'));

        //return view('owner.owner-dashboard');
    }

    private function getUserOwnerCounts()
    {
        $userCount = User::where('role', 'user')->count();
        $ownerCount = User::where('role', 'owner')->count();

        return [
            'userCount' => $userCount,
            'ownerCount' => $ownerCount,
        ];
    }

    private function getMonthlyBookingData($role, $user)
    {
        $query = Bookings::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        );

        if ($role === 'owner') {
            $query->whereHas('room.building', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $bookings = $query->groupBy('month')
            ->orderBy('month')
            ->get();

        $categories = [];
        $data = [];

        foreach ($bookings as $booking) {
            $categories[] = Carbon::parse($booking->month . '-01')->format('Y-m');
            $data[] = (int) $booking->total;
        }

        return [
            'categories' => $categories,
            'data' => $data,
        ];
    }

    public function getRevenueChartData(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $period = $request->input('period', 'month');
        $revenueData = $this->getRevenueData($period, $role, $user);

        return response()->json([
            'data' => $revenueData['data'],
            'categories' => $revenueData['categories']
        ]);
    }

    private function getRevenueData($period, $role, $user)
    {
        $query = Bookings::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(totalPrice) as total')
        );

        if ($role === 'owner') {
            $query->whereHas('room.building', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }


        switch ($period) {
            case 'day':
                $query->groupBy('date');
                break;
            case 'week':
                $query->groupBy(DB::raw('YEARWEEK(created_at)'));
                $query->groupBy('date');
                break;
            case 'month':
                $query->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'));
                $query->groupBy('date');
                break;
            case 'year':
                $query->groupBy(DB::raw('YEAR(created_at)'));
                $query->groupBy('date');
                break;
        }

        $revenues = $query->orderBy('date')->get();
        $categories = [];
        $data = [];

        foreach ($revenues as $revenue) {
            if ($period === 'day') {
                $categories[] = Carbon::parse($revenue->date)->format('Y-m-d');
            } elseif ($period === 'week') {
                $firstDayOfWeek = Carbon::parse($revenue->date)->startOfWeek();
                $categories[] = $firstDayOfWeek->format('Y-m-d');
            } elseif ($period === 'month') {
                $categories[] = Carbon::parse($revenue->date . '-01')->format('Y-m');
            } elseif ($period === 'year') {
                $categories[] = Carbon::parse($revenue->date . '-01-01')->format('Y');
            }
            $data[] = (float) $revenue->total;
        }

        return [
            'categories' => $categories,
            'data' => $data,
        ];
    }

    public function Autocomplete(Request $request)
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
