<x-app-layout>
    @include('homepage.homepage-search')

    <x-product-grid :products="[1, 2, 3, 4]" icon="icon-meeting-room" title="Meeting room" href="#" />
    <x-product-grid :products="[1, 2, 3, 4]" icon="icon-conference-room" title="Conference room" href="#" />

    @include('homepage.trusted-by-thoudsands')

    @include('homepage.easy-to-book')

    <x-front-footer />
</x-app-layout>