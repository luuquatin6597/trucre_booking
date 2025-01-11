<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <div class="container pt-[140px]">
        @include('components.front-breadcrumb', ['title' => 'Booking'])
        <div class="gap-[100px] pt-24">

            <form id="bookingForm" action="{{ route('payment.vnpay') }}" method="POST">
                @csrf
                <div class="room-info">
                    <h2 class="room-title text-heading-3 font-bold pb-24">{{$room->name}}</h2>

                    <div class="pb-24">
                        <p class="text-title-1 font-bold pb-12">Maximum</p>
                        <div class="flex gap-24 items-center">
                            <p class="text-gray-600">Table: {{$room->maxTable}}</p>
                            <p class="text-gray-600">Chair: {{$room->maxChair}}</p>
                            <p class="text-gray-600">People: {{$room->maxPeople}}</p>
                        </div>
                    </div>
                </div>

                <div class="room-booking mt-[24px] flex gap-[100px]">
                    <div class="user-booking w-[calc(40%-50px)]">
                        <x-text-input class="w-full mb-[24px]" required type="text" name="userName"
                            placeholder="Name" />
                        <x-text-input class="w-full mb-[24px]" required type="email" name="userEmail"
                            placeholder="Email" />
                        <x-text-input class="w-full mb-[24px]" required type="number" name="userPhone"
                            placeholder="Phone" />
                    </div>
                    <div class="info-booking w-[calc(60%-50px)]">
                        <input id="room_id" type="hidden" name="room_id" value="{{$room->id}}">
                        <input id="frequency" type="hidden" name="frequency" value="{{$params['frequency']}}">
                        <input id="bookingType" type="hidden" name="bookingType" value="{{$params['bookingType']}}">
                        <input id="sessionType" type="hidden" name="sessionType" value="{{$params['sessionType']}}">

                        <div class="product-price justify-center flex items-center gap-[10px] pb-24"
                            data-all-day-price="{{ $room->allDayPrice }}" data-session-price="{{ $room->sessionPrice }}"
                            data-compare-price="{{ $room->comparePrice }}"
                            data-exchange-rate="{{ getExchangeRate('USD', session('currency') ?? 'USD') }}">
                            <span class="price text-heading-3 font-bold text-red">
                                {{ format_currency($room['bookingType'] === 'All day' ? $room->allDayPrice : $room->sessionPrice * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
                            </span>
                            @if ($room->comparePrice)
                                <span class="compare-price font-bold text-heading-4 text-gray-300 line-through">
                                    {{ format_currency($room->comparePrice * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
                                </span>
                            @endif
                            <input id="priceInput" type="hidden" name="price"
                                value="{{$room['bookingType'] === 'All day' ? $room->allDayPrice : $room->sessionPrice}}">
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

                        <div class="pt-24">
                            <p id="taxElement" class="text-center text-gray-300"></p>
                            <p class="text-title-1 font-bold pt-12 text-center">
                                Total Price:<span id="totalPrice">{{$room->allDayPrice}}</span>
                            </p>
                            <input id="totalPriceInput" type="hidden" name="totalPrice" />
                            <input id="taxInput" type="hidden" name="tax" />
                        </div>
                    </div>
                </div>

                <div class="flex gap-24 pt-24">
                    <x-primary-button type="submit" class="w-full" name="redirect" onclick="prepareBooking(event)">
                        VN PAY
                        <svg width="35" height="35" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px"
                            viewBox="0 0 48 48" id="b">
                            <defs>
                                <style>
                                    .c {
                                        stroke-linecap: round;
                                    }

                                    .c,
                                    .d {
                                        fill: none !important;
                                        stroke: #fff;

                                        stroke-linejoin: round;
                                    }
                                </style>
                            </defs>
                            <path class="d"
                                d="m28.6222,37.7222l14.4444-14.4444c.5778-.5778.5778-1.7333,0-2.3111l-8.6667-8.6667c-.5778-.5778-1.7333-.5778-2.3111,0l-6.3556,6.3556-9.2444-9.2444c-.5778-.5778-1.7333-.5778-2.3111,0l-9.2444,9.2444c-.5778.5778-.5778,1.7333,0,2.3111l16.7556,16.7556c1.7333,1.7333,5.2,1.7333,6.9333,0Z" />
                            <path class="c" d="m25.7333,18.6556l-8.0889,8.0889c-2.3111,2.3111-4.6222,2.3111-6.9333,0" />
                            <g>
                                <path class="c"
                                    d="m18.2222,30.7889c-1.1556,1.1556-2.3111,1.1556-3.4667,0m22.5333-15.6c-1.262-1.1556-2.8889-.5778-4.0444.5778l-15.0222,15.0222" />
                                <path class="c"
                                    d="m18.2222,15.7667c-4.6222-4.6222-10.4,1.1556-5.7778,5.7778l5.2,5.2-5.2-5.2" />
                                <path class="c" d="m23.4222,20.9667l-4.0444-4.0444" />
                                <path class="c"
                                    d="m21.6889,22.7l-4.6222-4.6222c-.5778-.5778-1.4444-1.4444-2.3111-1.1556" />
                                <path class="c"
                                    d="m14.7556,20.3889c-.5778-.5778-1.4444-1.4444-1.1556-2.3111m5.7778,6.9333l-4.6222-4.6222" />
                            </g>
                            <script xmlns="" />
                        </svg>
                    </x-primary-button>
                </div>
            </form>
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
            switch ('{{$params['sessionType']}}') {
                case 'All day':
                    switchTab('all-day', $('.tab-button')[0]);
                    break;
                case 'Morning':
                    switchTab('morning', $('.tab-button')[1]);
                    break;
                case 'Afternoon':
                    switchTab('afternoon', $('.tab-button')[2]);
                    break;
                case 'Evening':
                    switchTab('evening', $('.tab-button')[3]);
                    break;
            }

            const dateStart = new Date('{{$params['startAt']}}');
            const dateEnd = new Date('{{$params['endAt']}}');
            const formatStart = $.datepicker.formatDate("mm/dd/yy", dateStart);
            const formatEnd = $.datepicker.formatDate("mm/dd/yy", dateEnd);
            $("#startAt").val(formatStart);
            $("#endAt").val(formatEnd);

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
                    minDate: dateStart,
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
                    minDate: dateStart,
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
            updateTotalPrice();
        })

        function switchTab(tabId, button) {
            const activeIndicator = document.getElementById('active-indicator');
            const rect = button.getBoundingClientRect();
            const parentRect = button.parentElement.getBoundingClientRect();

            activeIndicator.style.width = `${rect.width}px`;
            activeIndicator.style.left = `${rect.left - parentRect.left}px`;

            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach((btn) => btn.classList.remove('text-white', 'font-bold'));
            button.classList.add('text-white', 'font-bold');

            // Update the price based on the selected tab
            const priceElement = document.querySelector('.product-price .price');
            const productPrice = document.querySelector('.product-price');
            const priceInput = document.getElementById('priceInput');
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
                    priceInput.value = allDayPrice;
                    frequencyInput.value = 'All day';
                    bookingTypeInput.value = 'All day';
                    sessionTypeInput.value = 'All day';
                    break;
                case 'morning':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    priceInput.value = sessionPrice;
                    frequencyInput.value = 'Session';
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Morning';
                    break;
                case 'afternoon':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    priceInput.value = sessionPrice;
                    frequencyInput.value = 'Session';
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Afternoon';
                    break;
                case 'evening':
                    priceElement.textContent = format_currency(sessionPrice * exchangeRate, currentCurrency);
                    priceInput.value = sessionPrice;
                    frequencyInput.vãalue = 'Session';
                    bookingTypeInput.value = 'Session';
                    sessionTypeInput.value = 'Evening';
                    break;
            }
            updateTotalPrice();
        }
        function getDatesToCheck(startAt, endAt, frequency) {
            let datesToCheck = [];
            const startDate = new Date(startAt);
            const endDate = new Date(endAt);
            let currentDate = new Date(startDate);

            while (currentDate <= endDate) {
                datesToCheck.push(new Date(currentDate));
                if (frequency === 'All day') {
                    currentDate.setDate(currentDate.getDate() + 1);
                } else if (frequency === 'Session') {
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            }
            return datesToCheck.map(date => $.datepicker.formatDate('yy-mm-dd', date));
        }
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
        function updateTotalPrice() {
            const startAtInput = $("#startAt");
            const endAtInput = $("#endAt");
            const totalPriceElement = document.getElementById('totalPrice');
            const totalPriceInput = document.getElementById('totalPriceInput');
            const taxElement = document.getElementById('taxElement');
            const taxInput = document.getElementById('taxInput');

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
                let tax = 0;
                if (frequencyInput.value === 'All day') {
                    tax = dayDiff * allDayPrice * 0.1;
                    totalPrice = dayDiff * allDayPrice + tax;
                    totalPriceInput.value = dayDiff * allDayPrice;
                    taxInput.value = tax;
                } else {
                    tax = dayDiff * sessionPrice * 0.1;
                    totalPrice = dayDiff * sessionPrice + tax;
                    totalPriceInput.value = dayDiff * sessionPrice;
                    taxInput.value = tax;
                }
                taxElement.textContent = 'Tax: ' + format_currency(tax * exchangeRate, currentCurrency);
                totalPriceElement.textContent = format_currency(totalPrice * exchangeRate, currentCurrency);
            } else {
                tax = allDayPrice * 0.1;
                taxElement.textContent = 'Tax: ' + format_currency(tax * exchangeRate, currentCurrency);
                totalPriceElement.textContent = format_currency((allDayPrice + tax) * exchangeRate, currentCurrency);
                totalPriceInput.value = allDayPrice;
                taxInput.value = tax;
            }
        }
        function prepareBooking(event) {
            const form = document.getElementById('bookingForm');
            const inputs = form.querySelectorAll('input, select');

            const params = new URLSearchParams();
            inputs.forEach(input => {
                if (input.name) {
                    params.append(input.name, input.value);
                }
            });

            const startAt = params.get('startAt');
            const endAt = params.get('endAt');
            const frequency = params.get('frequency');

            const disabledDates = @json($allBookedDates).map(function (date) {
                try {
                    return $.datepicker.parseDate('yy-mm-dd', date);
                } catch (error) {
                    return date;
                }
            });

            const productPrice = document.querySelector('.product-price');
            const exchangeRate = parseFloat(productPrice.dataset.exchangeRate);
            const priceInput = document.getElementById('priceInput');
            const totalPriceInput = document.getElementById('totalPriceInput');
            const taxInput = document.getElementById('taxInput');
            const currentCurrency = '{{ session('currency') ?? 'USD' }}';
            let price = parseFloat(priceInput.value);
            let totalPrice = parseFloat(totalPriceInput.value);
            let tax = parseFloat(taxInput.value);

            price = price * exchangeRate;
            totalPrice = totalPrice * exchangeRate;
            tax = tax * exchangeRate;
            console.log("giá đã đổi:", price, totalPrice, tax)

            priceInput.value = Math.round(price);
            totalPriceInput.value = Math.round(totalPrice);
            taxInput.value = Math.round(tax);
            console.log("giá đã làm tròn:", priceInput.value, totalPriceInput.value, taxInput.value)

            //debugger;
            const datesToCheck = getDatesToCheck(startAt, endAt, frequency);
            const hasConflict = checkDateConflicts(datesToCheck, disabledDates);
            if (hasConflict) {
                alert('The selected date range is not available. Please choose another one.');
                event.preventDefault();
                return;
            }

            // Submit the form instead of redirecting
            form.submit();
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