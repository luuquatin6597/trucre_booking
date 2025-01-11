@extends('admin.index')
@section('admin')
<?php
use App\Models\Buildings;
$buildings = Buildings::all();
$options = [];
foreach ($buildings as $key => $building) {
    $options[$key] = [
        'value' => $building->id,
        'name' => $building->id . ' - ' . $building->name . ' - ' . $building->address
    ];
}
?>

<div class="relative">
    <x-admin-breadcrumb title="Rooms" subtitle="List rooms" link="admin.rooms" />

    <x-modal-add modalTitle="Add room" route="admin.rooms.add" modalId="addRoomModal" formId="addRoomForm">
        <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" />
        <div class="flex">
            <x-input-group name="startAt" label="Start At" placeholder="Enter start at" type="date" required="true" />
            <x-input-group name="endAt" label="End At" placeholder="Enter end at" type="date" required="true" />
        </div>
        <x-input-group name="price" label="Price" placeholder="Enter price" type="number" required="true" />
        <x-input-group name="comparePrice" label="Compare Price" placeholder="Enter compare price" type="number"
            required="true" />
        <div class="flex">
            <x-input-group name="allDayPrice" label="All Day Price" placeholder="Enter all day price" type="number"
                required="true" />
            <x-input-group name="sessionPrice" label="Session Price" placeholder="Enter session price" type="number"
                required="true" />
        </div>
        <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true" />
        <div class="flex">
            <x-input-group name="maxChair" label="Max Chair" placeholder="Enter max chair" type="number"
                required="true" />
            <x-input-group name="maxTable" label="Max Table" placeholder="Enter max table" type="number"
                required="true" />
            <x-input-group name="maxPeople" label="Max People" placeholder="Enter max people" type="number"
                required="true" />
        </div>
        <x-textarea-group name="tags" label="Tags" placeholder="Enter tags" required="true" />
        <x-textarea-group name="furniture" label="Furniture" placeholder="Enter furniture" required="true" />

        <div class="form-group">
            <label for="building">Select building</label>
            <select name="building_id" id="building_id" class="form-control" required>
                <option value="">Select building</option>
                @foreach ($buildings as $key => $building)
                    <option value="{{ $building->id }}">
                        {{ $building->id . ' - ' . $building->name . ' - ' . $building->address }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="floor">Select type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">Select type</option>
                <option value="Meeting room">Meeting room</option>
                <option value="Conference room">Conference room</option>
            </select>
        </div>

        <div class="form-group">
            <label for="images">Upload image</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple placeholder="Select image" />
        </div>

        <div id="image-list d-flex gap-2"></div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <input type="hidden" name="status" value="waiting" id="status" />
    </x-modal-add>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <x-admin-table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Compare Price</th>
                <th>All day price</th>
                <th>Session price</th>
                <th>Images</th>
                <th style="width: 250px;">Description</th>
                <th>Max Chair</th>
                <th>Max Table</th>
                <th>Max People</th>
                <th>Furniture</th>
                <th>Tags</th>
                <th>Building</th>
                <th>Start at</th>
                <th>End at</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($rooms->isEmpty())
                <p>No rooms found.</p>
            @else
                @foreach ($rooms as $key => $room)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $room->id }}</td>
                        <td><a href="{{route('admin.rooms.get', $room->id)}}">{{ $room->name }}</a></td>
                        <td>{{ format_currency($room->price * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>{{ format_currency($room->comparePrice * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>{{ format_currency($room->allDayPrice * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>{{ format_currency($room->sessionPrice * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td></td>
                        <td
                            style="width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">
                            {{ $room->description }}</td>
                        <td>{{ $room->maxChair }}</td>
                        <td>{{ $room->maxTable }}</td>
                        <td>{{ $room->maxPeople }}</td>
                        <td>{{ $room->furniture }}</td>
                        <td>{{ $room->tags }}</td>
                        <td><a href="{{route('admin.buildings.get', $room->building->id)}}">{{ $room->building->name }}</a></td>
                        <td>{{ $room->startAt }}</td>
                        <td>{{ $room->endAt }}</td>
                        <td>{{ $room->status }}</td>
                        <td>{{ $room->created_at }}</td>
                        <td>{{ $room->updated_at }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editUserModal{{ $room->id }}"><i class="mdi mdi-pencil"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteUserModal{{ $room->id }}"><i class="mdi mdi-delete"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </x-admin-table>
</div>

<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
    $(document).ready(function () {
        $('input[type="file"]').on('change', function () {
            var files = this.files;
            var images = [];
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (event) {
                    images.push(event.target.result);
                    $('#image-list').html('');
                    $.each(images, function (index, image) {
                        $('#image-list').append('<img src="' + image + '" style="max-width: 100px; height: 100px; object-fit: cover;">');
                    });
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
