@extends('admin.index')
@section('admin')

<?php
use App\Models\Images;
use App\Models\Bookings;
?>
<div class="relative">
    <x-admin-breadcrumb title="Buildings" subtitle="{{ $building->id }} - {{ $building->name }}"
        link="admin.buildings" />

    <h3 class="text-xl font-semibold mb-3">Building Information</h3>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="d-flex justify-content-center p-3 rounded-bottom">
                    <span class="h4 mb-0 text-dark">{{ $building->name }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row profile-body">
        <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="card-title mb-0">Owner</h6>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                        <p class="text-muted">{{ $building->user->firstName . ' ' . $building->user->lastName }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">ID:</label>
                        <p class="text-muted">{{ $building->user->id }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                        <p class="text-muted">
                            <a href="{{ $building->map }}">{{ $building->address }}</a>
                        </p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Country:</label>
                        <p class="text-muted">{{ $building->country }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Status:</label>
                        <p class="text-muted">{{ $building->status }}</p>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-primary w-full" href="{{ route('admin.users.get', $building->user->id) }}">See
                            profile</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-6 middle-wrapper grid-margin">
            <div class="row">
                @if($building->rooms->count() > 0)
                            @foreach ($building->rooms as $room)
                                        <?php        $image = Images::where('room_id', $room->id)->first();
                                $totalBooking = Bookings::where('room_id', $room->id)->count();
                                $totalRevenue = Bookings::where('room_id', $room->id)->sum('totalPrice'); ?>

                                        <div class="col-md-12 grid-margin">
                                            <div class="card rounded">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <img class="img-xs rounded-circle" src="{{ asset($image->url) }}" alt="">
                                                            <div class="ms-2">
                                                                <a href="{{ route('admin.rooms.get', $room->id) }}">{{ $room->name }}</a>
                                                                <p
                                                                    class="tx-11 {{ $room->status === 'active' ? 'text-green' : 'text-yellow' }}">
                                                                    {{ $room->status }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-between">
                                                        <p>Total booking: <strong>{{ $totalBooking }}</strong></p>
                                                        <p>Total revenue:
                                                            <strong>{{ format_currency($totalRevenue * getExchangeRate('USD', session('currency')), session('currency'))}}</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="{{ route('admin.rooms.get', $room->id) }}" class="btn btn-primary ml-auto">See
                                                        details</a>

                                                </div>
                                            </div>
                                        </div>
                            @endforeach
                @else
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">No room found.</h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection