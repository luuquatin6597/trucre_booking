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
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<style>
    /* Tùy chỉnh thanh trượt */
    #slider-range {
        height: 8px;
        background: linear-gradient(to right, #0429f8, #0429f8);
        border-radius: 4px;
        position: relative;
    }

    /* Tùy chỉnh nút kéo */
    .ui-slider-handle {
        width: 24px;
        height: 24px;
        background-color: #ff5722;
        border-radius: 50%;
        border: 2px solid #fff;
        top: -8px; /* Căn chỉnh nút kéo với thanh */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    /* Hiệu ứng hover cho nút kéo */
    .ui-slider-handle:hover {
        background-color: #ff7043;
    }

    /* Hiệu ứng khi kéo nút */
    .ui-slider-handle:active {
        background-color: #e64a19;
        transform: scale(1.1);
    }
</style>

</head>

<body class="">
    <x-front-header></x-front-header>

    <main>
        {{ $slot }}
    </main>
</body>

</html>
