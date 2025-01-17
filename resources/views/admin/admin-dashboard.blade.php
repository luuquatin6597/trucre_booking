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
                    <h6 class="card-title mb-0">REVENUE AFTER COMISSION & COMISSION</h6>
                </div>
                <!-- <div id="storageChart"></div> -->
                <div class="row my-3">
                    <div class="col-12">
                        <div>
                            <label class="text-uppercase fw-bolder">COMISSION</label>
                            <h5 class="fw-bolder mb-0">
                                {{ format_currency($comission * getExchangeRate('USD', session('currency')), session('currency')) }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div>
                            <label class="text-uppercase fw-bolder">REVENUE AFTER COMISSION</label>
                            <h5 class="fw-bolder mb-0">
                                {{ format_currency($revenueAfterComission * getExchangeRate('USD', session('currency')), session('currency')) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->

<div id="alert-container"></div>

<script>
    function showAlert(type, message) {
        var alert = `<div class="fixed bottom-1 right-1 alert alert-${type} alert-dismissible fade show z-3" role="alert">
                    <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
                    <button type="button" class="btn-close py-0 h-100" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>`;
        $('#alert-container').html(alert);
        setTimeout(function () {
            $('.alert').alert('close');
        }, 5000);
    }

    if ('{{ session()->has('success') }}') {
        showAlert('success', '{{ session()->get('success') }}');
    } else if ('{{ session()->has('error') }}') {
        showAlert('error', '{{ session()->get('error') }}');
    }

    window.userRole = @json($role);
    var revenueChartData = @json($revenueChartData);
    var revenueChartCategories = @json($revenueChartCategories);
    window.monthlyBookingChartData = @json($monthlyBookingChartData);
    window.monthlyBookingChartCategories = @json($monthlyBookingChartCategories);
    window.userCount = @json($revenueAfterComission);
    window.ownerCount = @json($comission);
</script>
@endsection