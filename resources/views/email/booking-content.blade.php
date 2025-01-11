<div style="font-family: Arial, sans-serif; color: #333; line-height: 1.6; max-width: 600px; margin: 20px auto;">
    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 10px;">
        <h2 style="color: #007bff; margin-bottom: 20px; margin-top: 0;">Booking Confirmation - ID: {{ $booking->id }}
        </h2>
        <p style="margin-bottom: 15px;">
            Hello <span style="font-weight: bold;">{{ $booking->userName }}</span>,
        </p>
        <p style="margin-bottom: 15px;">
            Thank you for your booking with
            <a href="{{ route('homepage') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">
                Trucre Booking
            </a>
        </p>
        <h4 style="margin-bottom: 10px; font-size: 1.2em; font-weight: bold; color: #555;">Booking Details:</h4>
        <div style="padding-left: 20px;">
            <p style="margin-bottom: 5px;">
                <strong style="font-weight: bold;">Room:</strong> <a style="color: #007bff; text-decoration: none;"
                    href="{{ route('room.room', $booking->room_id) }}" title="{{ $room->name }}">{{ $room->name }}</a>
            </p>
            <p style="margin-bottom: 5px;">
                <strong style="font-weight: bold;">Booking Type:</strong> {{ $booking->bookingType }}
            </p>
            <p style="margin-bottom: 5px;">
                <strong style="font-weight: bold;">Start At:</strong> {{ $booking->startAt }}
            </p>
            <p style="margin-bottom: 5px;">
                <strong style="font-weight: bold;">End At:</strong> {{ $booking->endAt }}
            </p>
            <p style="margin-bottom: 5px;">
                <strong style="font-weight: bold;">Total Price:</strong> {{ format_usd($booking->totalPrice) }}
            </p>
        </div>
    </div>
    <div style="margin-top: 20px; padding: 15px; background-color: #e0e0e0; border-radius: 10px;">
        <h4 style="margin-bottom: 10px; margin-top: 0; font-size: 1.2em; font-weight: bold; color: #555;">Building
            Information:</h4>
        <p style="margin-bottom: 5px;">
            <strong style="font-weight: bold;">Building name:</strong> {{ $building->name }}
        </p>
        <p style="margin-bottom: 5px;">
            <strong style="font-weight: bold;">Address:</strong>
            <a href="{{$building->map}}" style="color: #007bff; text-decoration: none;">{{ $building->address }}</a>
        </p>
    </div>
    <div style="margin-top: 20px; padding: 15px; background-color: #f0f0f0; border-radius: 10px;">
        <h4 style="margin-bottom: 10px; margin-top: 0; font-size: 1.2em; font-weight: bold; color: #555;">Contact us by
            another way:
        </h4>
        <p style="margin-bottom: 5px;">
            <strong style="font-weight: bold;">Phone:</strong> (+84) 123 456 789
        </p>
        <p style="margin-bottom: 5px;">
            <strong style="font-weight: bold;">Email:</strong>
            <a href="mailto: contact.trucre@gmail.com"
                style="color: #007bff; text-decoration: none;">contact.trucre@gmail.com</a>
        </p>
    </div>
</div>