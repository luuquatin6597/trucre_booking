<?php
$optionPeoples = ['Select people', 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
$optionTables = ['Select table', 10, 20, 40, 60, 80, 100, 120, 140, 160, 180, 200];
$optionChairs = ['Select chair', 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
?>

@section('title', 'Category - ' . config('app.name', 'Trucre booking'))

<x-app-layout>
    <div class="pt-[140px] pb-[100px]">
        <div class="container">
            <div class="left relative">
                <!-- Tabs -->
                <div class="flex items-center w-full pb-24 relative">
                    <a href="{{ route('categories.index', ['type' => 'meeting-room']) }}"
                        class="{{ request('type') === 'meeting-room' ? 'text-secondary-300 font-bold' : 'text-gray-500' }} text-center text-[35px] border-r border-gray-100 pr-24 mr-[24px]">
                        MEETING ROOM
                    </a>

                    <a href="{{ route('categories.index', ['type' => 'conference-room']) }}"
                        class="{{ request('type') === 'conference-room' ? 'text-secondary-300 font-bold' : 'text-gray-500' }} text-center text-[35px]">
                        CONFERENCE ROOM
                    </a>
                </div>

                <!-- Tag Section -->
                @if (isset($selectedTag) && $selectedTag)
                    <h2 class="text-xl font-bold mb-4">Results for tag: #{{ $selectedTag }}</h2>
                @endif

                <form
                    class="bg-white rounded-[38px] shadow-[9px_14px_45px_1px_rgba(0,0,0,0.15)] flex flex-col gap-24 p-24"
                    action="{{ route('categories.index') }}" method="GET">
                    <!-- Group 1: Inputs with Search Button -->
                    <div class="flex items-center gap-4 w-full">
                        <!-- Start At -->
                        <div class="flex-1 min-w-[305px]">
                            <x-text-input type="date" name="startAt" for="startAt"
                                class="w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0"
                                placeholder="Start Date" />
                        </div>
                        <!-- End At -->
                        <div class="flex-1 min-w-[305px]">
                            <x-text-input type="date" name="endAt" for="endAt"
                                class="w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0"
                                placeholder="End Date" />
                        </div>

                        <!-- Select Place -->
                        <select id="place-filter" name="country"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 border-none outline-none w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0">
                            <option value="" disabled selected>Select place</option>
                            @foreach($items as $items)
                                <option value="{{ $items }}">{{ ucfirst(str_replace('_', ' ', ltrim($items, '#'))) }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Select People -->
                        <select id="maxPeople-filter" name="maxPeople"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 border-none outline-none w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0">
                            @foreach($optionPeoples as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <!-- Search Button -->
                        <x-primary-button
                            class="w-[50px] h-[50px] bg-orange-500 rounded-full flex items-center justify-center">
                            @include('components.icons.icon-search')
                        </x-primary-button>
                    </div>

                    <!-- Divider Line -->
                    <div class="w-full h-px bg-gray-100"></div>

                    <!-- Group 2: Price Slider and Other Inputs -->
                    <div class="flex items-center gap-4 w-full">
                        <!-- Price Slider -->
                        <div id="slider-range-container" class="flex-1 min-w-[420px] flex items-center gap-2">
                            <span id="min-price" class="text-gray-500 px-2">0</span>
                            <div id="slider-range" class="w-full"></div>
                            <span id="max-price" class="text-gray-500 px-2">2000</span>
                        </div>

                        <!-- Select Tables -->
                        <select id="maxTable-filter" name="maxTable"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 border-none outline-none w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0">
                            @foreach($optionTables as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <!-- Select Chairs -->
                        <select id="maxChair-filter" name="maxChair"
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 border-none outline-none w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0">
                            @foreach($optionChairs as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        <!-- Furniture Text Input -->
                        <x-text-input type="text" name="furniture" id="furniture"
                            class="w-full border-gray-300 rounded-[50px] h-[50px] px-4 py-0"
                            placeholder="Select furniture" />

                        <!-- Clear Button -->
                        <button type="reset" class="text-gray-500 flex gap-[6px] items-center h-[50px]">
                            <span>CLEAR</span>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.96497 0.594766L1.56449 7.99524C0.771471 8.78826 0.771471 10.073 1.56449 10.866L4.10216 13.4036C4.48281 13.7843 4.99986 13.9968 5.53911 13.9968L8.87932 14H9.1775H15.9848C16.5463 14 16.9999 13.5464 16.9999 12.9849C16.9999 12.4235 16.5463 11.9699 15.9848 11.9699H12.0482L16.1941 7.82395C16.9872 7.03093 16.9872 5.74623 16.1941 4.95321L11.8389 0.594766C11.0459 -0.198255 9.76116 -0.198255 8.96814 0.594766H8.96497ZM9.1775 11.9699H8.87932H5.53594L2.99827 9.4322L6.95387 5.47661L11.3123 9.83505L9.1775 11.9699Z"
                                    fill="#8A8A8A" />
                            </svg>
                        </button>
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
                const paginationContainer = document.querySelector('.pagination');
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

            function createSliderPrice() {
                const minPrice = {{ $minPrice }};
                const maxPrice = {{ $maxPrice }};

                $("#slider-range").slider({
                    range: true,
                    min: minPrice,
                    max: maxPrice,
                    step: 5,
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
            const initialMinPrice = {{ $minPrice }};
            const initialMaxPrice = {{ $maxPrice }};
            createSliderPrice(initialMinPrice, initialMaxPrice);


            attachPaginationEvents();
        });
    </script>
    <x-front-footer />
</x-app-layout>