<?php
    $optionPeoples = ['Select people', 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
    $optionTables = ['Select table', 20, 40, 60, 80, 100, 120, 140, 160, 180, 200];
    $optionChairs = ['Select chair', 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
?>
<x-app-layout>
    <div class="pt-[140px] pb-[100px]">
        <div class="container">
            <div class="left relative">
                <!-- Tabs -->
                <div class="flex items-center gap-4 w-full mb-6 relative h-[50px]">
                    <a href="{{ route('categories.index', ['type' => 'meeting-room']) }}"
                       class="{{ request('type') === 'meeting-room' ? 'text-blue-500 font-bold border-b-4 border-blue-500' : 'text-gray-500' }} w-[239px] h-[38px] text-center text-lg leading-[50px]">
                        MEETING ROOM
                    </a>

                    <div class="h-[40px] w-px bg-gray-200 mx-2"></div>

                    <a href="{{ route('categories.index', ['type' => 'conference-room']) }}"
                       class="{{ request('type') === 'conference-room' ? 'text-blue-500 font-bold border-b-4 border-blue-500' : 'text-gray-500' }} w-[239px] h-[38px] text-center text-lg leading-[50px]">
                        CONFERENCE ROOM
                    </a>
                </div>

                 <!-- Tag Section -->
                @if (isset($selectedTag) && $selectedTag)
                    <h2 class="text-xl font-bold mb-4">Results for tag: #{{ $selectedTag }}</h2>
                @endif

                <form class="bg-white rounded-[38px] shadow-md flex flex-col gap-y-4 p-6 pt-[24px]" action="{{ route('categories.index') }}" method="GET">
                    <!-- Group 1: Inputs with Search Button -->
                    <div class="flex items-center gap-4 w-full">
                        <!-- Start At -->
                        <div class="flex-1 min-w-[305px]">
                            <x-text-input type="date" name="startAt" for="startAt" class="w-full border-gray-300 rounded-[50px] h-[60px] px-4 py-0 text-sm font-bold" placeholder="Start Date" />
                        </div>
                        <!-- End At -->
                        <div class="flex-1 min-w-[305px]">
                            <x-text-input type="date" name="endAt" for="endAt" class="w-full border-gray-300 rounded-[50px] h-[60px] px-4 py-0 text-sm font-bold" placeholder="End Date" />
                        </div>

                        <!-- Select Place -->
                        <select
                            id="place-filter"
                            name="country"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none w-full border-gray-300 rounded-[50px] h-[60px] px-4 py-0 text-sm font-bold">
                                <option value="" disabled selected>Select place</option>
                            @foreach($items as $items)
                                <option value="{{ $items }}">{{ ucfirst(str_replace('_', ' ', ltrim($items, '#'))) }}</option>
                            @endforeach
                        </select>

                        <!-- Select People -->
                        <select
                            id="maxPeople-filter"
                            name="maxPeople"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none w-full border-gray-300 rounded-[50px] h-[60px] px-4 py-0 text-sm font-bold">
                            @foreach($optionPeoples as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <!-- Search Button -->
                        <div class="min-w-[70px]">
                            <x-primary-button class="w-[60px] h-[60px] bg-orange-500 rounded-full flex items-center justify-center">
                                @include('components.icons.icon-search')
                            </x-primary-button>
                        </div>
                    </div>

                    <!-- Divider Line -->
                    <div class="w-full h-px bg-gray-200 my-6"></div>

                    <!-- Group 2: Price Slider and Other Inputs -->
                    <div class="flex items-center gap-4 w-full">
                        <!-- Price Slider -->
                        <div id="slider-range-container" class="flex-1 min-w-[420px] flex items-center gap-2">
                            <span id="min-price" class="text-gray-500 px-2">0</span>
                            <div id="slider-range" class="w-full"></div>
                            <span id="max-price" class="text-gray-500 px-2">2000</span>
                        </div>

                        <!-- Select Tables -->
                        <select
                            id="maxTable-filter"
                            name="maxTable"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none w-full border-gray-300 rounded-[50px] h-[60px] px-4 py-0 text-sm font-bold">
                            @foreach($optionTables as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <!-- Select Chairs -->
                        <select
                            id="maxChair-filter"
                            name="maxChair"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none w-full border-gray-300 rounded-[50px] h-[60px] px-4 py-0 text-sm font-bold">
                            @foreach($optionChairs as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <!-- Furniture Text Input -->
                        <div class="flex-1 min-w-[420px]">
                            <x-text-input type="text" name="furniture" id="furniture" class="w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0 font-bold" placeholder="Select furniture" />
                        </div>

                        <!-- Clear Button -->
                        <div class="flex-1 flex justify-end">
                            <button type="reset" class="text-gray-500 font-medium border border-gray-300 rounded-lg px-4 py-3 flex items-center gap-2 h-[60px] font-bold">
                                <span>CLEAR</span>
                                <img src="{{ asset('images/vector.png') }}" alt="Clear Icon" class="w-4 h-[14px]" style="width: 16px; height: 14px;">
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="pb-100 pt-100">
                <div id="product-grid">
                    <x-category-product-grid :products="$products" />
                </div>
                <div class="pagination flex justify-center mt-8">
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filters = document.querySelectorAll('#people-filter, #tables-filter, #chairs-filter, #place, #startAt, #endAt, #furniture');
        const productGrid = document.getElementById('product-grid');
        const paginationContainer = document.querySelector('.pagination');

        const updateProducts = (url) => {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => response.json())
            .then(data => {
                productGrid.innerHTML = data.productsHtml;
                paginationContainer.innerHTML = data.paginationHtml;
                 // Đồng bộ lại giá trị filter
        document.getElementById('place-filter').value = url.searchParams.get('country');
        document.getElementById('maxPeople-filter').value = url.searchParams.get('maxPeople');
        document.getElementById('maxTable-filter').value = url.searchParams.get('maxTable');
        document.getElementById('maxChair-filter').value = url.searchParams.get('maxChair');
                attachPaginationEvents();
            })
            .catch(error => console.error('Error:', error));
        };

        const attachPaginationEvents = () => {
    const paginationLinks = paginationContainer.querySelectorAll('a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const url = new URL(this.href);
            const minPrice = $("#slider-range").slider("values", 0);
            const maxPrice = $("#slider-range").slider("values", 1);

            url.searchParams.set('minPrice', minPrice);
            url.searchParams.set('maxPrice', maxPrice);

            updateProducts(url.toString());
        });
    });
};

        attachPaginationEvents();
    });
    function createSliderPrice() {
        const minPrice = {{ $minPrice ?? 0 }};
        const maxPrice = {{ $maxPrice ?? 2000 }};

        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 2000,
            step: 100,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                $('#min-price').text(ui.values[0]);
                $('#max-price').text(ui.values[1]);
            },
            stop: function (event, ui) {
                filterByPrice(ui.values[0], ui.values[1]);
            }
        });

        $('#min-price').text(minPrice);
        $('#max-price').text(maxPrice);
    }

    function filterByPrice(minPrice, maxPrice) {
        const url = new URL(window.location.href);
        url.searchParams.set('minPrice', minPrice);
        url.searchParams.set('maxPrice', maxPrice);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            const productGrid = document.getElementById('product-grid');
            const paginationContainer = document.querySelector('.pagination');

            productGrid.innerHTML = data.productsHtml;
            paginationContainer.innerHTML = data.paginationHtml;

            attachPaginationEvents();
        })
        .catch(error => console.error('Error fetching filtered products:', error));
    }

    // Khởi tạo giá trị ban đầu cho slider
    const initialMinPrice = {{ $minPrice ?? 0 }};
    const initialMaxPrice = {{ $maxPrice ?? 2000 }};
    createSliderPrice(initialMinPrice, initialMaxPrice);
</script>
    <x-front-footer />
</x-app-layout>
