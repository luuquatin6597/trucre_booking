@extends('admin.index')
@section('admin')
<?php
    ?>

<div class="relative">
    <x-admin-breadcrumb title="Rooms" subtitle="{{ $room->id }} - {{ $room->name }}" link="admin.rooms" />

    <h3 class="text-xl font-semibold mb-3">Room Information</h3>
    <div class="row mb-3">
        <p class="text-lg font-semibold mb-3">Max people: {{ $room->maxPeople }}</p>
        <p class="text-lg font-semibold mb-3">Max table: {{ $room->maxTable }}</p>
        <p class="text-lg font-semibold mb-3">Max chair: {{ $room->maxChair }}</p>
    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title mb-4">Select booking type</h6>
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                        aria-controls="all" aria-selected="true" data-booking-type="all">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="all-day-tab" data-bs-toggle="tab" href="#all-day" role="tab"
                        aria-controls="all-day" aria-selected="false" data-booking-type="all-day">All day</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="morning-tab" data-bs-toggle="tab" href="#morning" role="tab"
                        aria-controls="morning" aria-selected="false" data-booking-type="morning">Morning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="afternoon-tab" data-bs-toggle="tab" href="#afternoon" role="tab"
                        aria-controls="afternoon" aria-selected="false" data-booking-type="afternoon">Afternoon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="everning-tab" data-bs-toggle="tab" href="#everning" role="tab"
                        aria-controls="everning" aria-selected="false" data-booking-type="evening">Evening</a>
                </li>
            </ul>
            <div id='fullcalendar'></div>
        </div>
    </div>

    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle1" class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><span
                            class="visually-hidden">close</span></button>
                </div>
                <div id="modalBody1" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button class="btn btn-primary">Event Page</button> -->
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var roomEvents = @json($events);
</script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('assets/vendors/fullcalendar/main.min.css') }}">
<script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendors/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
@endsection