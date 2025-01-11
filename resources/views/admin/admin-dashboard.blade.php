@extends('admin.index')
@section('admin')
<div class="row">
    <div class="col-md-3 grid-margin">
        <div class="card bg-secondary-300 border-0 text-white">
            <div class="card-body">
                <h5 class="card-title fw-bolder">
                    Total Booking
                </h5>
                <h4 class="text-xl" id="totalBooking">{{ $totalBookings }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card bg-secondary-300 border-0 text-white">
            <div class="card-body">
                <h5 class="card-title fw-bolder">
                    Total Revenue
                </h5>
                <h4 class="text-xl" id="totalRevenue">
                    {{ format_currency($totalRevenue * getExchangeRate('USD', session('currency')), session('currency')) }}
                </h4>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card bg-secondary-300 border-0 text-white">
            <div class="card-body">
                <h5 class="card-title fw-bolder">
                    Total Room
                </h5>
                <h4 class="text-xl" id="totalRoom">{{ $totalRooms }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card bg-secondary-300 border-0 text-white">
            <div class="card-body">
                <h5 class="card-title fw-bolder">
                    Total Building
                </h5>
                <h4 class="text-xl" id="totalBuilding">{{ $totalBuildings }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">Revenue</h6>
                    <div class="d-flex justify-content-end btn-group mb-3 mb-md-0" role="group"
                        aria-label="Basic example">
                        <button type="button"
                            class="btn btn-outline-primary revenue-chart-btn {{ $selectedPeriod == 'day' ? 'active' : '' }}"
                            id="revenueDayBtn" data-period="day">Today</button>
                        <button type="button"
                            class="btn btn-outline-primary revenue-chart-btn d-none d-md-block {{ $selectedPeriod == 'week' ? 'active' : '' }}"
                            id="revenueWeekBtn" data-period="week">Week</button>
                        <button type="button"
                            class="btn btn-outline-primary revenue-chart-btn {{ $selectedPeriod == 'month' ? 'active' : '' }}"
                            id="revenueMonthBtn" data-period="month">Month</button>
                        <button type="button"
                            class="btn btn-outline-primary revenue-chart-btn {{ $selectedPeriod == 'year' ? 'active' : '' }}"
                            id="revenueYearBtn" data-period="year">Year</button>
                    </div>
                </div>
                <div id="revenueChart"></div>
            </div>
        </div>
    </div>
</div><!-- row -->

<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Monthly Booking</h6>
                </div>
                <div id="monthlySalesChart"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">USER & OWNER</h6>
                </div>
                <div id="storageChart"></div>
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-end">
                        <div>
                            <label
                                class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">Total
                                User <span class="p-1 ms-1 rounded-circle bg-secondary"></span></label>
                            <h5 class="fw-bolder mb-0 text-end">{{ $userCount }}</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <label class="d-flex align-items-center tx-10 text-uppercase fw-bolder"><span
                                    class="p-1 me-1 rounded-circle bg-primary"></span> Total Users
                            </label>
                            <h5 class="fw-bolder mb-0">{{ $userCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->

<script>
    window.userCount = @json($userCount);
    window.ownerCount = @json($ownerCount);
    window.userRole = @json($role);
    var revenueChartData = @json($revenueChartData);
    var revenueChartCategories = @json($revenueChartCategories);
    window.monthlyBookingChartData = @json($monthlyBookingChartData);
    window.monthlyBookingChartCategories = @json($monthlyBookingChartCategories);
    window.userCount = @json($userCount);
    window.ownerCount = @json($ownerCount);
</script>
@endsection