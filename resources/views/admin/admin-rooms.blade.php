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
        <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true"
            value="Meeting room" />
        <div class="flex">
            <x-input-group name="startAt" label="Start At" placeholder="Enter start at" type="date" required="true"
                value="2025-01-01" />
            <x-input-group name="endAt" label="End At" placeholder="Enter end at" type="date" required="true"
                value="2026-01-01" />
        </div>
        <x-input-group name="price" label="Price" placeholder="Enter price" type="number" required="true"
            value="300000" />
        <x-input-group name="comparePrice" label="Compare Price" placeholder="Enter compare price" type="number"
            required="true" value="400000" />
        <div class="flex">
            <x-input-group name="weekPrice" label="Week Price" placeholder="Enter week price" type="number"
                required="true" value="280000" />
            <x-input-group name="monthPrice" label="Month Price" placeholder="Enter month price" type="number"
                required="true" value="260000" />
            <x-input-group name="yearPrice" label="Year Price" placeholder="Enter year price" type="number"
                required="true" value="240000" />
        </div>
        <div class="flex">
            <x-input-group name="weekendPrice" label="Weekend Price" placeholder="Enter weekend price" type="number"
                required="true" value="320000" />
            <x-input-group name="holidayPrice" label="Holiday Price" placeholder="Enter holiday price" type="number"
                required="true" value="340000" />
        </div>
        <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true"
            value="Des" />
        <div class="flex">
            <x-input-group name="maxChair" label="Max Chair" placeholder="Enter max chair" type="number" required="true"
                value="30" />
            <x-input-group name="maxTable" label="Max Table" placeholder="Enter max table" type="number" required="true"
                value="10" />
            <x-input-group name="maxPeople" label="Max People" placeholder="Enter max people" type="number"
                required="true" value="30" />
        </div>
        <x-textarea-group name="tags" label="Tags" placeholder="Enter tags" required="true" value="Meeting room" />
        <x-textarea-group name="furniture" label="Furniture" placeholder="Enter furniture" required="true" value="TV" />

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
            <label for="images">Upload image</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple placeholder="Select image" />
        </div>

        <div id="image-list"></div>

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
                <th>Week price</th>
                <th>Month price</th>
                <th>Year price</th>
                <th>Weekend price</th>
                <th>Holiday price</th>
                <th>Images</th>
                <th>Description</th>
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
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->comparePrice }}</td>
                        <td>{{ $room->weekPrice }}</td>
                        <td>{{ $room->monthPrice }}</td>
                        <td>{{ $room->yearPrice }}</td>
                        <td>{{ $room->weekendPrice }}</td>
                        <td>{{ $room->holidayPrice }}</td>
                        <td></td>
                        <td>{{ $room->description }}</td>
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

        // $('#addRoomForm').on('submit', function (e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     $.ajax({
        //         url: $(this).attr('action'),
        //         type: $(this).attr('method'),
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function (response) {
        //             console.log(response);
        //         },
        //         error: function (xhr, status, error) {
        //             console.log(error);
        //         }
        //     })
        // });
    });
</script>
@endsection