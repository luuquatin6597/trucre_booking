@extends('admin.index')

@section('admin')
<x-admin-breadcrumb title="Bookings" subtitle="List Booking" link="admin.booking" />

<x-admin-table>
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Room</th>
            <th>Start at</th>
            <th>End at</th>
            <th>Booking type</th>
            <th>Session type</th>
            <th>Total price</th>
            <th>User ID</th>
            <th>User name</th>
            <th>User email</th>
            <th>User phone</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if ($bookings->isEmpty())
            <p>No bookings found.</p>
        @else
            @foreach ($bookings as $key => $booking)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="{{ route('admin.booking.get', $booking->id) }}">{{ $booking->id }}</a></td>
                    <td><a href="{{ route('admin.rooms.get', $booking->room_id) }}">{{ $booking->room->name }}</a>
                    </td>
                    <td>{{ $booking->startAt }}</td>
                    <td>{{ $booking->endAt }}</td>
                    <td>{{ $booking->bookingType }}</td>
                    <td>{{ $booking->sessionType }}</td>
                    <td>
                        {{ format_currency($booking->totalPrice * getExchangeRate($booking->currency, 'USD'), 'USD') }}
                    </td>
                    <td><a href="{{ route('admin.users.get', $booking->user->id) }}">{{ $booking->user->id }}</a></td>
                    <td>{{ $booking->userName }}</td>
                    <td>{{ $booking->userEmail }}</td>
                    <td>{{ $booking->userPhone }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</x-admin-table>
@endsection