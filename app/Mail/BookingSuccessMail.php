<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $room;
    public $building;


    public function __construct($booking, $room, $building)
    {
        $this->booking = $booking;
        $this->room = $room;
        $this->building = $building;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Trucre Booking - Booking Confirmation - #' . $this->booking->id,
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'email.booking-content',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}