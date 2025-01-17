<?php
use App\Models\Rooms;
$meetingRooms = Rooms::where('type', 'Meeting room')->where('status', 'active')->limit(8)->get();
$conferenceRooms = Rooms::where('type', 'Conference room')->where('status', 'active')->limit(4)->get();
?>

@section('title', 'Homepage - ' . config('app.name', 'Trucre booking'))

<x-app-layout>
    @include('homepage.homepage-search')

    <x-product-grid :products="$meetingRooms" icon="icon-meeting-room" title="Meeting room"
        href="{{ route('categories.index', ['type' => 'meeting-room']) }}" />
    <x-product-grid :products="$conferenceRooms" icon="icon-conference-room" title="Conference room"
        href="{{ route('categories.index', ['type' => 'conference-room']) }}" />

    @include('homepage.trusted-by-thoudsands')

    @include('homepage.easy-to-book')
</x-app-layout>