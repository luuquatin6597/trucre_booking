<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Admin Trucre booking">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Admin Trucre booking</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css')}}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/font/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css')}}">
    <!-- End layout styles -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png')}}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currencySelect = document.getElementById('currency-select');
            let currentCurrency = '{{ session('currency') ?? 'USD' }}';
            currencySelect.value = currentCurrency;
            currencySelect.addEventListener('change', function () {
                const selectedCurrency = currencySelect.value;
                fetch('/set-currency', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ currency: selectedCurrency }),
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            console.error('Failed to set currency');
                        }
                    });
            });
        });
    </script>
</head>

<body>
    <div class="main-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <x-common.sidebar />
        <!-- partial -->

        <div class="page-wrapper">
            <!-- partial:partials/_navbar.html -->
            <x-common.header />
            <!-- partial -->
            <div class="page-content">
                <select id="currency-select"
                    class="fixed z-[1] top-[150px] right-0 rounded-l-[20px] border-primary-300 appearance-none">
                    <option value="USD" {{ session('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="VND" {{ session('currency') == 'VND' ? 'selected' : '' }}>VND</option>
                    <option value="EUR" {{ session('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                    <option value="GBP" {{ session('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                </select>

                @yield('admin')
            </div>

            <!-- partial:partials/_footer.html -->
            <x-common.footer />
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/template.js')}}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/data-table.js')}}"></script>
    <script src="{{ asset('assets/js/dashboard-dark.js')}}"></script>
    <!-- End custom js for this page -->

</body>

</html>