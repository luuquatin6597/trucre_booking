<?php
$navList = [
    [
        'name' => 'Home',
        'url' => '/',
        'active' => true,
        'child' => []
    ],
    [
        'name' => 'Explore',
        'url' => '/',
        'active' => false,
        'child' => [
            [
                'name' => 'Explore all',
                'url' => '/',
                'img' => 'assets/img/dropdown-menu-1.png',
                'active' => false
            ],
            [
                'name' => 'Meeting room',
                'url' => '/',
                'img' => 'assets/img/dropdown-menu-2.png',
                'active' => false
            ],
            [
                'name' => 'Conference room',
                'url' => '/',
                'img' => '',
                'active' => false
            ]
        ]
    ],
    [
        'name' => 'Partner',
        'url' => '/',
        'active' => false,
        'child' => []
    ],
]
?>

<header class="fixed top-0 left-0 z-50 w-full bg-[rgb(255,255,255,0.9)]">
    <div class="container">
        <div class="flex flex-wrap justify-between items-center mx-auto py-24">
            <div class="header-left w-[250px]">
                <a href="{{ route('homepage')}}" class="flex items-center">
                    <picture>
                        <x-application-logo class="block w-auto" />
                    </picture>
                </a>
            </div>
            <div class="header-center">
                <nav class="navigation flex items-center" aria-label="Main navigation">
                    <ul class="flex items-center gap-[32px]">
                    <?php foreach ($navList as $navItem): ?>
                        <?php if(empty($navItem['child'])): ?>
                            <li class="item">
                                <a
                                    class="flex items-center gap-[8px] text-title-1 font-bold px-[17px] py-[5px] transition ease-in-out duration-300 hover:bg-primary-300 hover:text-white rounded-full <?= $navItem['active'] ? 'bg-primary-300 text-white' : 'text-gray-500' ?>"
                                    href="<?= htmlspecialchars($navItem['url']) ?>"
                                    title="<?= htmlspecialchars($navItem['name']) ?>"
                                    <?= $navItem['active'] && 'aria-current="page"' ?>
                                >
                                    <?= htmlspecialchars($navItem['name']) ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="item group relative dropdown">
                                <div
                                    class="flex items-center gap-[8px] text-title-1 font-bold px-[17px] py-[5px] cursor-default transition ease-in-out duration-300 hover:bg-primary-300 hover:text-white rounded-full <?= $navItem['active'] ? 'bg-primary-300 text-white' : 'text-gray-500' ?>"
                                    <?= $navItem['active'] && 'aria-current="page"' ?>
                                    aria-haspopup="true" aria-expanded="false"
                                >
                                    <?= htmlspecialchars($navItem['name']) ?>

                                    @include('components.icons.icon-arrow-down')
                                </div>
                                <div class="group-hover:block dropdown-menu absolute hidden h-auto left-1/2 translate-x-[-50%] pt-[20px]">
                                    <div class="w-max max-w-[660px] flex flex-wrap bg-white rounded-20 p-20 gap-20 shadow-[2px_2px_30px_0px_rgb(0,0,0,0.15)]">
                                        @foreach ($navItem['child'] as $child)
                                            <x-dropdown-menu :child="$child" />
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
            <div class="header-right" style="width: 250px">
                <div class="flex items-center justify-end gap-12">
                    <div class="flex items-center justify-center">
                        <div class="icon-search cursor-pointer flex items-center justify-center w-[42px] h-[42px]"
                            onclick="openSearchBar()">
                            @include('components.icons.icon-search')
                        </div>
                        <div class="search-bar">
                            <form class="flex items-center bg-gray-100 rounded-full" action="">
                                <input
                                    class="w-full h-[42px] bg-gray-100 border-none outline-none focus:border-transparent focus:ring-0 text-body-1 px-0"
                                    type="search" placeholder="Search">
                                <div class="btn-close flex items-center justify-center w-[42px] h-[42px] cursor-pointer" onclick="closeSearchBar()">
                                    @include('components.icons.icon-close')
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="flex group relative">
                        <div class="h-[42px] w-[42px] cursor-pointer flex items-center justify-center">
                            @include('components.icons.icon-profile')
                        </div>
                        <div class="min-w-[150px] group-hover:block dropdown-menu absolute hidden h-auto left-1/2 translate-x-[-50%] pt-[60px]">
                            <div class="flex flex-wrap bg-white rounded-20 shadow-[2px_2px_30px_0px_rgb(0,0,0,0.15)]">
                            @if (Route::has('login'))
                                @auth
                                <a href="{{ route('dashboard') }}" class="p-20 flex items-center justify-center">
                                    Profile
                                </a>
                                <hr>
                                <a href="{{ route('logout') }}" class="p-20 flex items-center justify-center">
                                    Logout
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="p-20 flex items-center justify-center">
                                    Login
                                </a>
                                <span class="w-full h-[1px] bg-gray-200"></span>
                                <a href="{{ route('register') }}" class="p-20 flex items-center justify-center">
                                    Register
                                </a>
                                @endauth
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function openSearchBar() {
        var searchBar = document.querySelector('.search-bar');
        var headerCenter = document.querySelector('.header-center');
        var headerRight = document.querySelector('.header-right');

        headerCenter.classList.add('hidden');
        headerRight.style.width = 'calc(100% - 290px)';
        searchBar.parentElement.classList.add('is-open');
    }
    function closeSearchBar() {
        var searchBar = document.querySelector('.search-bar');
        var headerCenter = document.querySelector('.header-center');
        var headerRight = document.querySelector('.header-right');

        headerCenter.classList.remove('hidden');
        headerRight.style.width = '250px';
        searchBar.parentElement.classList.remove('is-open');
    }
</script>
