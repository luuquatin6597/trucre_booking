<?php
use App\Models\Rooms;
$meetingRooms = Rooms::where('type', 'Meeting room')->get();
$conferenceRooms = Rooms::where('type', 'Conference room')->get();
?>

<x-app-layout>
    @include('homepage.homepage-search')

    <x-product-grid max="8" :products="$meetingRooms" icon="icon-meeting-room" title="Meeting room"
        href="{{ route('categories.index', ['type' => 'meeting-room']) }}" />
    <x-product-grid max="8" :products="$conferenceRooms" icon="icon-conference-room" title="Conference room"
        href="{{ route('categories.index', ['type' => 'conference-room']) }}" />

    @include('homepage.trusted-by-thoudsands')

    @include('homepage.easy-to-book')
</x-app-layout>