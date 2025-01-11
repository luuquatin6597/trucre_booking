<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            getCurrencySession = '{{ session('currency') }}';
            if (getCurrencySession == '') {
                fetch('/set-currency', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ currency: 'USD' }),
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            console.error('Failed to set currency');
                        }
                    });
            } else {
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
            }
        });
    </script>
</head>

<body class="">
    <x-front-header />

    <main>
        {{ $slot }}
    </main>

    <select id="currency-select" class="fixed top-[150px] right-0 rounded-l-[20px] border-primary-300 appearance-none">
        <option value="USD" {{ session('currency') == 'USD' ? 'selected' : '' }}>USD</option>
        <option value="VND" {{ session('currency') == 'VND' ? 'selected' : '' }}>VND</option>
        <option value="EUR" {{ session('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
        <option value="GBP" {{ session('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
    </select>

    @include('contact.contact')
    <x-front-footer />
</body>

</html>