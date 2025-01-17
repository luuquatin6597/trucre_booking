@extends('admin.index')
@section('admin')
<?php
use App\Models\Buildings;
if (Auth::user()->role == 'admin') {
    $buildings = Buildings::where('status', 'active')->get();
} else if (Auth::user()->role == 'owner') {
    $buildings = Buildings::where('user_id', Auth::user()->id)->where('status', 'active')->get();
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

        <div id="image-list" class="d-flex gap-2 flex-wrap"></div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (Auth::user()->role == 'owner')
            <input type="hidden" name="status" value="waiting" id="status" />
        @elseif (Auth::user()->role == 'admin')
            <input type="hidden" name="status" value="active" id="status" />
        @endif
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
                <th>Images</th>
                <th>Name</th>
                <th>Price</th>
                <th>Compare Price</th>
                <th>All day price</th>
                <th>Session price</th>
                <th>Description</th>
                <th>Max Chair</th>
                <th>Max Table</th>
                <th>Max People</th>
                <th>Furniture</th>
                <th>Tags</th>
                <th>Building</th>
                <th>Status</th>
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
                        <td>
                            @if ($room->images->first())
                                <img src="{{ asset($room->images->first()->url) }}" />
                            @endif
                        </td>
                        <td><a href="{{route('admin.rooms.get', $room->id)}}">{{ $room->name }}</a></td>
                        <td>{{ format_currency($room->price * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>{{ format_currency($room->comparePrice * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>{{ format_currency($room->allDayPrice * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>{{ format_currency($room->sessionPrice * getExchangeRate('USD', session('currency')), session('currency'))}}
                        </td>
                        <td>
                            <div
                                style="width: 250px;white-space: normal;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 4;">
                                {{ $room->description }}
                            </div>
                        </td>
                        <td>{{ $room->maxChair }}</td>
                        <td>{{ $room->maxTable }}</td>
                        <td>{{ $room->maxPeople }}</td>
                        <td>
                            <div
                                style="width: 250px;white-space: normal;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 4;">
                                {{ $room->furniture }}
                            </div>
                        </td>
                        <td>
                            <div
                                style="width: 250px;white-space: normal;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 4;">
                                {{ $room->tags }}
                            </div>
                        </td>
                        <td><a href="{{route('admin.buildings.get', $room->building->id)}}">{{ $room->building->name }}</a></td>
                        <td class="status-{{ $room->status }}">{{ $room->status }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editRoomModal"
                                data-id="{{ $room->id }}" data-action="{{ route('admin.rooms.update', $room->id) }}"
                                data-target="#editRoomModal">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteRoomModal"
                                data-id="{{ $room->id }}" data-action="{{ route('admin.rooms.destroy', $room->id) }}"
                                data-target="#deleteRoomModal">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </x-admin-table>
</div>

<div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoomModalLabel">Edit room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="editRoomForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" />
                    <div class="flex">
                        <x-input-group name="startAt" label="Start At" placeholder="Enter start at" type="date"
                            required="true" />
                        <x-input-group name="endAt" label="End At" placeholder="Enter end at" type="date"
                            required="true" />
                    </div>
                    <x-input-group name="price" label="Price" placeholder="Enter price" type="number" required="true" />
                    <x-input-group name="comparePrice" label="Compare Price" placeholder="Enter compare price"
                        type="number" required="true" />
                    <div class="flex">
                        <x-input-group name="allDayPrice" label="All Day Price" placeholder="Enter all day price"
                            type="number" required="true" />
                        <x-input-group name="sessionPrice" label="Session Price" placeholder="Enter session price"
                            type="number" required="true" />
                    </div>
                    <x-textarea-group name="description" label="Description" placeholder="Enter description"
                        required="true" />
                    <div class="flex">
                        <x-input-group name="maxChair" label="Max Chair" placeholder="Enter max chair" type="number"
                            required="true" />
                        <x-input-group name="maxTable" label="Max Table" placeholder="Enter max table" type="number"
                            required="true" />
                        <x-input-group name="maxPeople" label="Max People" placeholder="Enter max people" type="number"
                            required="true" />
                    </div>
                    <x-textarea-group name="tags" label="Tags" placeholder="Enter tags" required="true" />
                    <x-textarea-group name="furniture" label="Furniture" placeholder="Enter furniture"
                        required="true" />

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
                        <input type="file" class="form-control" id="images" name="images[]" multiple
                            placeholder="Select image" />
                    </div>

                    <div id="edit-image-list" class="d-flex gap-2 flex-wrap"></div>

                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if (Auth::user()->role == 'owner')
                        <input type="hidden" name="status" value="waiting" id="status" />
                    @elseif (Auth::user()->role == 'admin')
                        <input type="hidden" name="status" value="active" id="status" />
                    @endif
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button form="editRoomForm" type="submit" class="btn btn-primary">Save</button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

<div id="alert-container"></div>

<x-modal-delete modalId="deleteRoomModal" formId="deleteRoomForm" modalTitle="Delete room"></x-modal-delete>


<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
    $(document).ready(function () {
        function showAlert(type, message) {
            var alert = `<div class="fixed bottom-1 right-1 alert alert-${type} alert-dismissible fade show z-3" role="alert">
                    <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
                    <button type="button" class="btn-close py-0 h-100" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>`;
            $('#alert-container').html(alert);
            setTimeout(function () {
                $('.alert').alert('close');
            }, 5000);
        }

        if ('{{ session()->has('success') }}') {
            showAlert('success', '{{ session()->get('success') }}');
        } else if ('{{ session()->has('error') }}') {
            showAlert('error', '{{ session()->get('error') }}');
        }

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

        $('#editRoomModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút được nhấn
            var roomId = button.data('id'); // ID của room
            var actionUrlTemplate = button.data('action');
            var modal = $(this);

            // Gửi request để lấy thông tin room
            $.get(`/admin/rooms/modal/${roomId}`, function (room) {
                // Điền thông tin room vào form
                modal.find('[name="name"]').val(room.name);
                modal.find('[name="type"]').val(room.type);
                modal.find('[name="description"]').val(room.description);
                modal.find('[name="price"]').val(room.price);
                modal.find('[name="comparePrice"]').val(room.comparePrice);
                modal.find('[name="allDayPrice"]').val(room.allDayPrice);
                modal.find('[name="sessionPrice"]').val(room.sessionPrice);
                modal.find('[name="maxChair"]').val(room.maxChair);
                modal.find('[name="maxTable"]').val(room.maxTable);
                modal.find('[name="maxPeople"]').val(room.maxPeople);
                modal.find('[name="tags"]').val(room.tags);
                modal.find('[name="furniture"]').val(room.furniture);
                modal.find('[name="startAt"]').val(new Date(room.startAt).toISOString().slice(0, 10));
                modal.find('[name="endAt"]').val(new Date(room.endAt).toISOString().slice(0, 10));

                // Hiển thị hình ảnh hiện tại (nếu có)
                if (room.images) {
                    var imagesHtml = '';
                    room.images.forEach(function (image) {
                        imagesHtml += `<img src="${image.url}" class="img-thumbnail" style="width: 100px; margin-right: 10px;">`;
                    });
                    modal.find('#edit-image-list').html(imagesHtml);
                } else {
                    console.log('no image')
                }

                // Cập nhật action cho form
                modal.find('form').attr('action', actionUrlTemplate);
            });
        });

        $('#deleteRoomModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút được nhấn
            var roomId = button.data('id'); // ID của room
            var actionUrlTemplate = button.data('action');
            var modal = $(this);

            // Cập nhật action cho form
            modal.find('form').attr('action', actionUrlTemplate);
        });
    });
</script>
@endsection