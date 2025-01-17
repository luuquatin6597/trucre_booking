<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Buildings;
use App\Models\Rooms;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $user = Auth::user();
        $role = $user->role;

        $totalBookings = Bookings::count();
        $totalRevenue = Bookings::sum('totalPrice');
        $totalRooms = Rooms::count();
        $totalBuildings = Buildings::count();

        // Khởi tạo dữ liệu cho tháng làm mặc định
        $revenueData = $this->getRevenueData('month');
        $revenueChartData = $revenueData['data'];
        $revenueChartCategories = $revenueData['categories'];
        $selectedPeriod = 'month'; // Mặc định là tháng

        // Monthly Booking Chart Data
        $monthlyBookingData = $this->getMonthlyBookingData();
        $monthlyBookingChartData = $monthlyBookingData['data'];
        $monthlyBookingChartCategories = $monthlyBookingData['categories'];

        // User & Owner Count Data
        $userOwnerCounts = $this->getUserOwnerCounts();
        $userCount = $userOwnerCounts['userCount'];
        $ownerCount = $userOwnerCounts['ownerCount'];

        $comission = (Bookings::sum('totalPrice') - Bookings::sum('tax')) * 0.05;
        $revenueAfterComission = Bookings::sum('totalPrice') - $comission;

        return view('admin.admin-dashboard', compact('totalBookings', 'totalRevenue', 'totalRooms', 'totalBuildings', 'revenueChartData', 'revenueChartCategories', 'selectedPeriod', 'monthlyBookingChartData', 'monthlyBookingChartCategories', 'userCount', 'ownerCount', 'role', 'comission', 'revenueAfterComission'));
    }

    private function getRevenueData($period)
    {
        $query = Bookings::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(totalPrice) as total')
        );

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
                // Lấy ngày đầu tuần
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

    // Hàm xử lý request AJAX
    public function getRevenueChartData(Request $request)
    {
        $period = $request->input('period', 'month');
        $revenueData = $this->getRevenueData($period);

        return response()->json([
            'data' => $revenueData['data'],
            'categories' => $revenueData['categories']
        ]);
    }

    private function getMonthlyBookingData()
    {
        $bookings = Bookings::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )
            ->groupBy('month')
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

    private function getUserOwnerCounts()
    {
        $userCount = User::where('role', 'user')->count();
        $ownerCount = User::where('role', 'owner')->count();

        return [
            'userCount' => $userCount,
            'ownerCount' => $ownerCount,
        ];
    }
}