<?php
$gender = ['male' => ['value' => 'male', 'label' => 'Male'], ['value' => 'female', 'label' => 'Female']];
?>

<x-app-layout>
    <div class="container pt-[140px]">
        @include('components.front-breadcrumb', ['title' => __('Profile')])

        <div class="gap-24 pt-[50px]">
            <div class="mb-[20px]">
                <ul class="flex flex-wrap items-center justify-center text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg" id="booking-tab" data-tabs-target="#booking"
                            type="button" role="tab" aria-controls="booking" aria-selected="false">My booking</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg" id="changePassword-tab"
                            data-tabs-target="#changePassword" type="button" role="tab" aria-controls="changePassword"
                            aria-selected="false">Change Password</button>
                    </li>
                    <li role="presentation">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="inline-block p-4 rounded-t-lg" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div id="default-tab-content">
                <div class="p-24 bg-white rounded-20 shadow-[0px_0px_20px_0px_rgba(0,0,0,0.15)]" id="profile"
                    role="tabpanel" aria-labelledby="profile-tab">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <x-text-input class="w-full mb-[20px]" type="text" name="firstName" placeholder="First name"
                            value="{{ $user->firstName }}" />
                        <x-text-input class="w-full mb-[20px]" type="text" name="lastName" placeholder="Last name"
                            value="{{ $user->lastName }}" />
                        <x-text-input class="w-full mb-[20px]" type="date" name="dateOfBirth" placeholder="dd/mm/yyyy"
                            value="{{ $user->dateOfBirth }}" />
                        <x-text-input class="w-full mb-[20px]" type="email" name="email" placeholder="Email"
                            value="{{ $user->email }}" />
                        <x-text-input class="w-full mb-[20px]" type="text" name="username" placeholder="Username"
                            value="{{ $user->username }}" />
                        <x-text-input class="w-full mb-[20px]" type="number" name="phone" placeholder="Phone"
                            value="{{ $user->phone }}" />
                        <select
                            class="block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none w-full mb-[20px]">
                            @foreach($gender as $option)
                                <option value="{{ $option['value'] }}" @if($user->gender == $option['value'])
                                selected="selected" @endif>{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                        <x-text-input class="w-full mb-[20px]" type="text" name="address" placeholder="Address"
                            value="{{ $user->address }}" />
                        <x-text-input class="w-full mb-[20px]" type="text" name="country" placeholder="Country"
                            value="{{ $user->country }}" />
                        <x-primary-button class="ml-auto" type="submit">
                            Save
                        </x-primary-button>
                    </form>
                </div>

                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="booking" role="tabpanel"
                    aria-labelledby="booking-tab">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Room
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Start At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    End At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $booking->id }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('room.room', $booking->room_id) }}"
                                            title="{{ $booking->room->name }}">{{ $booking->room->name }}</a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $booking->startAt }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $booking->endAt }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ format_usd($booking->totalPrice) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="changePassword" role="tabpanel"
                    aria-labelledby="changePassword-tab">

                </div>
            </div>
        </div>
    </div>
    <script>
        const tabsElement = document.getElementById('default-tab');
        // create an array of objects with the id, trigger element (eg. button), and the content element
        const tabElements = [
            {
                id: 'profile',
                triggerEl: document.querySelector('#profile-tab'),
                targetEl: document.querySelector('#profile'),
            },
            {
                id: 'booking',
                triggerEl: document.querySelector('#booking-tab'),
                targetEl: document.querySelector('#booking'),
            },
            {
                id: 'changePassword',
                triggerEl: document.querySelector('#changePassword-tab'),
                targetEl: document.querySelector('#changePassword'),
            },
        ];

        // options with default values
        const options = {
            defaultTabId: 'profile',
            activeClasses:
                'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
            inactiveClasses:
                'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
            onShow: () => {
                console.log('tab is shown');
            },
        };

        // instance options with default values
        const instanceOptions = {
            id: 'default-tab',
            override: true
        };

        // tạo một hàm để hiển thị tab
        function showTab(tabId) {
            // ẩn tất cả các tab
            tabElements.forEach((tab) => {
                tab.triggerEl.classList.remove('text-blue-600', 'hover:text-blue-600', 'dark:text-blue-500', 'dark:hover:text-blue-400', 'border-blue-600', 'dark:border-blue-500');
                tab.targetEl.classList.add('hidden');
            });

            // hiển thị tab được chọn
            const selectedTab = tabElements.find((tab) => tab.id === tabId);
            selectedTab.triggerEl.classList.add('text-blue-600', 'hover:text-blue-600', 'dark:text-blue-500', 'dark:hover:text-blue-400', 'border-blue-600', 'dark:border-blue-500');
            selectedTab.targetEl.classList.remove('hidden');
        }

        // tạo một hàm để xử lý sự kiện click trên tab
        function handleTabClick(event) {
            const tabId = event.target.dataset.tabsTarget.replace('#', '');
            showTab(tabId);
        }

        // thêm sự kiện click vào các tab
        tabElements.forEach((tab) => {
            tab.triggerEl.addEventListener('click', handleTabClick);
        });

        // hiển thị tab mặc định
        showTab(options.defaultTabId);
    </script>
</x-app-layout>