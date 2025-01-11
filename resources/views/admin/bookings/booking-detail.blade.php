@extends('admin.index')
@section('admin')
<div class="relative">
    <x-admin-breadcrumb title="Bookings" subtitle="Booking Detail - {{ $booking->id }}" link="admin.rooms" />
</div>
<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-bold mb-4">Booking ID: {{ $booking->id }}</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-xl font-semibold mb-3">User Information</h3>
                    <p class="mb-3"><strong>Name:</strong> {{ $booking->userName ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Email:</strong> {{ $booking->userEmail ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Phone:</strong> {{ $booking->userPhone ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-3">Room Information</h3>
                    <p class="mb-3"><strong>Name:</strong> {{ $booking->room->name ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Type:</strong> {{ $booking->room->type ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Max people:</strong> {{ $booking->room->maxPeople ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Max Table:</strong> {{ $booking->room->maxTable ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Max Chair:</strong> {{ $booking->room->maxChair ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-3">Booking Information</h3>
                    <p class="mb-3"><strong>Start At:</strong> {{ $booking->startAt }}</p>
                    <p class="mb-3"><strong>End At:</strong> {{ $booking->endAt }}</p>
                    <p class="mb-3"><strong>Booking Type:</strong> {{ $booking->bookingType }}</p>
                    <p class="mb-3"><strong>Session Type:</strong> {{ $booking->sessionType }}</p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-3">Payment Information</h3>
                    <p class="mb-3"><strong>Status:</strong> {{ $booking->status }}</p>
                    <p class="mb-3"><strong>Currency:</strong> {{ $booking->currency }}</p>
                    <p class="mb-3"><strong>Payment method:</strong> {{ $booking->payment_method }}</p>
                    <p class="mb-3"><strong>Tax:</strong>
                        {{ format_currency($booking->tax * getExchangeRate($booking->currency, 'USD'), 'USD') }}
                    </p>
                    <p class="mb-3"><strong>Total Price:</strong>
                        {{ format_currency($booking->totalPrice * getExchangeRate($booking->currency, 'USD'), 'USD') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection