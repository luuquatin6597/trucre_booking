<?php
use App\Models\Bookings;
$roomFurnitures = explode(', ', $room->furniture);
$roomFurnitures[count($roomFurnitures) - 1] = rtrim(end($roomFurnitures), ',');

$roomTags = explode(', ', $room->tags);
$roomTags[count($roomTags) - 1] = rtrim(end($roomTags), ',');
$totalBooking = Bookings::where('room_id', $room->id)->count();
?>

@section('title', $room->name . ' - ' . config('app.name', 'Trucre booking'))


<x-app-layout>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    @include('room.image-slider', ['room' => $room])
    <div class="container pt-24">
        @include('components.front-breadcrumb', ['title' => $room->name])
        <div class="flex gap-[100px] pt-24">
            <div class="room-info w-[calc(100%-600px)]">
                <h2 class="room-title text-heading-3 font-bold pb-[50px]">{{$room->name}}</h2>

                <div class="pb-[50px]">
                    <p class="text-title-1 font-bold pb-12">Maximum</p>
                    <div class="flex gap-24 items-center">
                        <p class="text-gray-600">Table: {{$room->maxTable}}</p>
                        <p class="text-gray-600">Chair: {{$room->maxChair}}</p>
                        <p class="text-gray-600">People: {{$room->maxPeople}}</p>
                    </div>
                </div>

                <div class="pb-[50px]">
                    <p class="text-title-1 font-bold pb-12">Description</p>
                    <div class="flex gap-24 items-center">
                        <p class="text-gray-600 whitespace-pre-wrap">{{$room->description}}</p>
                    </div>
                </div>

                <div class="pb-[50px]">
                    <p class="text-title-1 font-bold pb-12">Furnitures</p>
                    <div class="grid grid-cols-3 gap-24">
                        @foreach ($roomFurnitures as $furniture)
                            <p class="furniture-item text-gray-600 flex first-letter:uppercase">{{$furniture}}</p>
                        @endforeach
                    </div>
                </div>

                <hr />

                <div class="py-[50px]">
                    <p class="text-title-1 font-bold pb-12">Tags</p>
                    <div class="flex gap-[10px] items-center">
                        @foreach ($roomTags as $tag)
                            <x-hashtag href="{{ route('categories.index', ['tags' => urlencode(trim($tag))]) }}"
                                class="mt-[12px] w-fit">
                                #{{ trim($tag) }}
                            </x-hashtag>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="room-booking w-[600px]">
                <form id="bookingForm" action="{{ route('booking.view') }}" method="GET">
                    @csrf
                    <input id="room_id" type="hidden" name="room_id" value="{{$room->id}}">
                    <input id="bookingType" type="hidden" name="bookingType" value="All day">
                    <input id="sessionType" type="hidden" name="sessionType" value="All day">

                    <div class="product-price justify-center flex items-center gap-[10px] pb-24"
                        data-all-day-price="{{ $room->allDayPrice }}" data-session-price="{{ $room->sessionPrice }}"
                        data-compare-price="{{ $room->comparePrice }}"
                        data-exchange-rate="{{ getExchangeRate('USD', session('currency') ?? 'USD') }}">
                        <span class="price text-heading-3 font-bold text-red">
                            {{ format_currency($room->allDayPrice * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
                        </span>
                        @if ($room->comparePrice)
                            <span class="compare-price font-bold text-heading-4 text-gray-300 line-through">
                                {{ format_currency($room->comparePrice * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-col items-center pb-24">
                        <div class="relative flex gap-[12px] bg-gray-100 rounded-full p-[10px]">
                            <div id="active-indicator"
                                class="absolute top-[6px] left-0 h-[calc(100%-12px)] bg-secondary-300 rounded-full transition-all duration-300">
                            </div>
                            <span
                                class="tab-button relative z-1 px-[28px] py-[12px] text-gray-600 focus:outline-none cursor-pointer"
                                onclick="switchTab('all-day', this)">
                                All day
                            </span>
                            <span class="block h-[inherit] w-[1px] bg-gray-400"></span>
                            <span
                                class="tab-button relative z-1 px-[28px] py-[12px] text-gray-600 focus:outline-none cursor-pointer"
                                onclick="switchTab('morning', this)">
                                Morning
                            </span>
                            <span
                                class="tab-button relative z-1 px-[28px] py-[12px] text-gray-600 focus:outline-none cursor-pointer"
                                onclick="switchTab('afternoon', this)">
                                Afternoon
                            </span>
                            <span
                                class="tab-button relative z-1 px-[28px] py-[12px] text-gray-600 focus:outline-none cursor-pointer"
                                onclick="switchTab('evening', this)">
                                Evening
                            </span>
                        </div>
                    </div>

                    <div class="flex gap-24">
                        <x-text-input class="w-full" type="text" name="startAt" placeholder="Start At" />
                        <x-text-input class="w-full" type="text" name="endAt" placeholder="End At" />
                    </div>

                    <p class="text-title-1 font-bold pt-24 text-center">Total Price:
                        <span id="totalPrice" data-total-price="{{$room->allDayPrice}}">
                            {{ format_currency($room->allDayPrice * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
                        </span>
                    </p>

                    <div class="flex gap-24 pt-24">
                        <x-primary-button type="submit" class="w-full">
                            Book Now
                        </x-primary-button>
                    </div>
                </form>

                <div class="flex items-center justify-center pt-24 text-heading-4">
                    Total bookings: <span class="font-bold" id="totalBooking"></span>
                </div>

                <div class="pt-24 flex items-center justify-center text-center">
                    <p class="font-bold">Share this:</p>
                    <div class="flex gap-[6px] items-center justify-center">
                        <!-- Facebook Share -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank" class="share-btn facebook hover:text-blue-600" title="Share on Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12,2C6.477,2,2,6.477,2,12c0,5.013,3.693,9.153,8.505,9.876V14.65H8.031v-2.629h2.474v-1.749 c0-2.896,1.411-4.167,3.818-4.167c1.153,0,1.762,0.085,2.051,0.124v2.294h-1.642c-1.022,0-1.379,0.969-1.379,2.061v1.437h2.995 l-0.406,2.629h-2.588v7.247C18.235,21.236,22,17.062,22,12C22,6.477,17.523,2,12,2z">
                                </path>
                            </svg>
                        </a>

                        <!-- Twitter Share -->
                        <a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($room->name) }}"
                            target="_blank" class="share-btn twitter hover:text-blue-400" title="Share on Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 50 50">
                                <path
                                    d="M 6.9199219 6 L 21.136719 26.726562 L 6.2285156 44 L 9.40625 44 L 22.544922 28.777344 L 32.986328 44 L 43 44 L 28.123047 22.3125 L 42.203125 6 L 39.027344 6 L 26.716797 20.261719 L 16.933594 6 L 6.9199219 6 z">
                                </path>
                            </svg>
                        </a>

                        <!-- LinkedIn Share -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                            target="_blank" class="share-btn linkedin hover:text-blue-700" title="Share on LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 50 50">
                                <path
                                    d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10 c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56 c3.97,0,7.19,2.73,7.19,8.26V39z">
                                </path>
                            </svg>
                        </a>

                        <!-- WhatsApp Share -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($room->name . ' ' . url()->current()) }}"
                            target="_blank" class="share-btn whatsapp hover:text-green-500" title="Share on WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 50 50">
                                <path
                                    d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z">
                                </path>
                            </svg>
                        </a>

                        <!-- Telegram share -->
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($room->name) }}"
                            target="_blank" class="share-btn telegram hover:text-blue-400" title="Share on Telegram">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 50 50">
                                <path
                                    d="M25,2c12.703,0,23,10.297,23,23S37.703,48,25,48S2,37.703,2,25S12.297,2,25,2z M32.934,34.375	c0.423-1.298,2.405-14.234,2.65-16.783c0.074-0.772-0.17-1.285-0.648-1.514c-0.578-0.278-1.434-0.139-2.427,0.219	c-1.362,0.491-18.774,7.884-19.78,8.312c-0.954,0.405-1.856,0.847-1.856,1.487c0,0.45,0.267,0.703,1.003,0.966	c0.766,0.273,2.695,0.858,3.834,1.172c1.097,0.303,2.346,0.04,3.046-0.395c0.742-0.461,9.305-6.191,9.92-6.693	c0.614-0.502,1.104,0.141,0.602,0.644c-0.502,0.502-6.38,6.207-7.155,6.997c-0.941,0.959-0.273,1.953,0.358,2.351	c0.721,0.454,5.906,3.932,6.687,4.49c0.781,0.558,1.573,0.811,2.298,0.811C32.191,36.439,32.573,35.484,32.934,34.375z">
                                </path>
                            </svg>
                        </a>

                        <!-- Instagram Share -->
                        <a href="https://www.instagram.com/" target="_blank"
                            class="share-btn instagram hover:text-pink-500" title="Share on Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 50 50">
                                <path
                                    d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                                </path>
                            </svg>
                        </a>

                        <!-- Copy Link -->
                        <button class="share-btn copy-link hover:text-gray-600" title="Copy link to clipboard"
                            onclick="copyToClipboard()">
                            <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .ui-datepicker-current-day a {
            background-color: rgba(251, 130, 0, 1) !important;
            color: white !important;
        }

        .share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all .2s ease;
        }

        .share-btn svg path {
            fill: #CBCBCB;
            transition: all .2s ease;
        }

        .share-btn:hover {
            background-color: #f1f1f1;
        }

        .share-btn:hover svg path {
            fill: #FF992C;
        }
    </style>

    <script>
        $(document).ready(function () {
            var $totalBooking = @json($totalBooking);
            $('#totalBooking').text($totalBooking === 0 ? 0 : $totalBooking);
            switchTab('all-day', $('.tab-button')[0]);

            var dateFormat = "mm/dd/yy";

            const today = new Date();
            const formattedToday = $.datepicker.formatDate(dateFormat, today);

            $("#startAt, #endAt").val(formattedToday);

            var bookedDates = @json($allBookedDates);

            var disabledDates = bookedDates.map(function (date) {
                try {
                    return $.datepicker.parseDate('yy-mm-dd', date);
                } catch (error) {
                    return date;
                }
            });

            var from = $("#startAt")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 2,
                    minDate: today,
                    beforeShowDay: function (date) {
                        var isEnabled = !isDateDisabled(date, disabledDates)
                        var isSelected = false
                        var startAtDate = $("#startAt").datepicker("getDate");
                        var endAtDate = $("#endAt").datepicker("getDate");
                        if (startAtDate && endAtDate) {
                            if (date >= startAtDate && date <= endAtDate) {
                                isSelected = true;
                            }
                        }
                        return [isEnabled, isSelected ? "ui-datepicker-current-day" : ""];
                    }
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                    updateTotalPrice();
                }),
                to = $("#endAt").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 2,
                    minDate: today,
                    beforeShowDay: function (date) {
                        var isEnabled = !isDateDisabled(date, disabledDates)
                        var isSelected = false
                        var startAtDate = $("#startAt").datepicker("getDate");
                        var endAtDate = $("#endAt").datepicker("getDate");
                        if (startAtDate && endAtDate) {
                            if (date >= startAtDate && date <= endAtDate) {
                                isSelected = true;
                            }
                        }
                        return [isEnabled, isSelected ? "ui-datepicker-current-day" : ""];
                    }
                })
                    .on("change", function () {
                        from.datepicker("option", "maxDate", getDate(this));
                        updateTotalPrice();
                    });
        })

        function isDateDisabled(date, disabledDates) {
            for (let i = 0; i < disabledDates.length; i++) {
                if (date.getTime() === disabledDates[i].getTime()) {
                    return true;
                }
            }
            return false;
        }
        function checkDateConflicts(datesToCheck, disabledDates) {
            for (const dateToCheck of datesToCheck) {
                try {
                    const date = $.datepicker.parseDate('yy-mm-dd', dateToCheck);
                    if (isDateDisabled(date, disabledDates)) {
                        return true; // Found conflict
                    }
                } catch (error) { }
            }
            return false; // No conflict
        }
        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }

        function switchTab(tabId, button) {
            const activeIndicator = document.getElementById('active-indicator');
            const rect = button.getBoundingClientRect();
            const parentRect = button.parentElement.getBoundingClientRect();

            activeIndicator.style.width = `${rect.width}px`;
            activeIndicator.style.left = `${rect.left - parentRect.left}px`;

            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach((btn) => btn.classList.remove('text-white', 'font-bold'));
            button.classList.add('text-white', 'font-bold');

            const priceElement = document.querySelector('.product-price .price');
            const productPrice = document.querySelector('.product-price');
            const allDayPrice = parseFloat(productPrice.dataset.allDayPrice);
            const sessionPrice = parseFloat(productPrice.dataset.sessionPrice);
            const bookingTypeInput = document.getElementById('bookingType');
            const sessionTypeInput = document.getElementById('sessionType');
            const exchangeRate = parseFloat(productPrice.dataset.exchangeRate);
            const currentCurrency = '{{ session('currency') ?? 'USD' }}';

            switch (tabId) {
                case 'all-day':
                    priceElement.textContent = format_currency(allDayPrice * exchangeRate, currentCurrency);
                    bookingTypeInput.value = 'All day';
                    sessionTypeInput.value = 'All day';
                    break;
                case 'morning':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Morning';
                    break;
                case 'afternoon':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Afternoon';
                    break;
                case 'evening':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Evening';
                    break;
            }
            updateTotalPrice();
        }
        function updateTotalPrice() {
            const startAtInput = $("#startAt");
            const endAtInput = $("#endAt");
            const totalPriceElement = document.getElementById('totalPrice');
            const startDate = startAtInput.datepicker("getDate");
            const endDate = endAtInput.datepicker("getDate");
            const productPrice = document.querySelector('.product-price');
            const allDayPrice = parseFloat(productPrice.dataset.allDayPrice);
            const sessionPrice = parseFloat(productPrice.dataset.sessionPrice);
            const exchangeRate = parseFloat(productPrice.dataset.exchangeRate);
            const currentCurrency = '{{ session('currency') ?? 'USD' }}';
            const sessionTypeInput = document.getElementById('sessionType');

            if (startDate && endDate) {
                const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
                let totalPrice = 0;
                if (sessionTypeInput.value === 'All day') {
                    totalPrice = dayDiff * allDayPrice;
                } else {
                    totalPrice = dayDiff * sessionPrice;
                }
                totalPriceElement.textContent = format_currency(totalPrice * exchangeRate, currentCurrency);
            } else {
                totalPriceElement.textContent = format_currency(allDayPrice * exchangeRate, currentCurrency);
            }
        }

        function format_currency(price, currency) {
            let symbol = '';
            let decimal = 0;
            switch (currency) {
                case 'USD':
                    symbol = '$';
                    decimal = 0;
                    break;
                case 'VND':
                    symbol = '₫';
                    decimal = 0;
                    break;
                case 'EUR':
                    symbol = '€';
                    decimal = 2;
                    break;
                case 'GBP':
                    symbol = '£';
                    decimal = 2;
                    break;
                default:
                    symbol = '$';
                    decimal = 0;
            }
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: currency,
            }).format(price);
        }

        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert("Link copied to clipboard!");
            });
        }
    </script>
</x-app-layout>