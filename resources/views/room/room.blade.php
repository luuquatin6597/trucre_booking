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
                <h2 class="room-title text-heading-3 font-bold pb-24">{{$room->name}}</h2>

                <div class="pb-24">
                    <p class="text-title-1 font-bold pb-12">Maximum</p>
                    <div class="flex gap-24 items-center">
                        <p class="text-gray-600">Table: {{$room->maxTable}}</p>
                        <p class="text-gray-600">Chair: {{$room->maxChair}}</p>
                        <p class="text-gray-600">People: {{$room->maxPeople}}</p>
                    </div>
                </div>

                <div>
                    <p class="text-title-1 font-bold pb-12">Description</p>
                    <div class="flex gap-24 items-center">
                        <p class="text-gray-600 whitespace-pre-wrap">{{$room->description}}</p>
                    </div>
                </div>
            </div>

            <div class="room-booking w-[600px]">
                <form id="bookingForm" action="{{ route('booking.view') }}" method="GET">
                    @csrf
                    <input id="room_id" type="hidden" name="room_id" value="{{$room->id}}">
                    <input id="frequency" type="hidden" name="frequency" value="All day">
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
                        <x-primary-button type="submit" class="w-full" onclick="prepareBooking(event)">
                            Book Now
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .ui-datepicker-current-day a {
            background-color: rgba(251, 130, 0, 1) !important;
            color: white !important;
        }
    </style>

    <script>
        $(document).ready(function () {
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
            const frequencyInput = document.getElementById('frequency');
            const bookingTypeInput = document.getElementById('bookingType');
            const sessionTypeInput = document.getElementById('sessionType');
            const exchangeRate = parseFloat(productPrice.dataset.exchangeRate);
            const currentCurrency = '{{ session('currency') ?? 'USD' }}';

            switch (tabId) {
                case 'all-day':
                    priceElement.textContent = format_currency(allDayPrice * exchangeRate, currentCurrency);
                    frequencyInput.value = 'All day';
                    bookingTypeInput.value = 'All day';
                    sessionTypeInput.value = 'All day';
                    break;
                case 'morning':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    frequencyInput.value = 'Session';
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Morning';
                    break;
                case 'afternoon':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    frequencyInput.value = 'Session';
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Afternoon';
                    break;
                case 'evening':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    frequencyInput.value = 'Session';
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
            const frequencyInput = document.getElementById('frequency');
            const startDate = startAtInput.datepicker("getDate");
            const endDate = endAtInput.datepicker("getDate");
            const productPrice = document.querySelector('.product-price');
            const allDayPrice = parseFloat(productPrice.dataset.allDayPrice);
            const sessionPrice = parseFloat(productPrice.dataset.sessionPrice);
            const exchangeRate = parseFloat(productPrice.dataset.exchangeRate);
            const currentCurrency = '{{ session('currency') ?? 'USD' }}';

            if (startDate && endDate) {
                const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
                let totalPrice = 0;
                if (frequencyInput.value === 'All day') {
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
    </script>
</x-app-layout>