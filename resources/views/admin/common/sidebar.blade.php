<?php
$menus = [
    [
        'name' => 'Dashboard',
        'route' => 'admin.dashboard',
        'icon' => '<i class="fa-solid fa-chart-line"></i>',
        'children' => [
        ]
    ],
    [
        'name' => 'Users',
        'route' => '',
        'icon' => '<i class="fa-regular fa-user"></i>',
        'children' => [
            [
                'name' => 'List users',
                'route' => 'admin.users',
            ],
            [
                'name' => 'Types of user',
                'route' => '',
            ],
            [
                'name' => 'Buildings',
                'route' => '',
            ],
            [
                'name' => 'Certificates',
                'route' => '',
            ]
        ]
    ],
    [
        'name' => 'Rooms',
        'route' => '',
        'icon' => '<i class="fa-regular fa-building"></i>',
        'children' => [
            [
                'name' => 'List rooms',
                'route' => '',
            ],
            [
                'name' => 'Categories',
                'route' => '',
            ],
            [
                'name' => 'Posts',
                'route' => '',
            ],
            [
                'name' => 'Certificates',
                'route' => '',
            ]
        ]
    ],
    [
        'name' => 'Booking',
        'route' => '',
        'icon' => '<i class="fa-regular fa-calendar"></i>',
        'children' => [
            [
                'name' => 'All booking',
                'route' => '',
            ],
            [
                'name' => 'Pending booking',
                'route' => '',
            ],
            [
                'name' => 'Approved booking',
                'route' => '',
            ],
            [
                'name' => 'Rejected booking',
                'route' => '',
            ]
        ]
    ]
]; // thêm dấu ngoặc đóng sau mảng $menus
?>

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('admin.dashboard')}}" class="sidebar-brand block h-[40px]">
            <x-application-logo style="height: 40px; width: auto;" />
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @foreach ($menus as $key => $menu)
                <li class="nav-item nav-category">{{$menu['name']}}</li>
                @if (isset($menu['children']) && count($menu['children']) > 0)
                    @foreach ($menu['children'] as $item)
                        <li class="nav-item">
                            <a href="{{$item['route'] === '' ? '#' : route($item['route'])}}" class="nav-link">
                                <span class="link-title">{{$item['name']}}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="nav-item">
                        <a href="{{ route($menu['route']) }}" class="nav-link">
                            <span class="link-title">{{$menu['name']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>