@extends('admin.index')

@section('admin')
<?php
$status = ['active' => 'active', 'inactive' => 'inactive'];
?>
<x-admin-breadcrumb title="Buildings" subtitle="List building" link="admin.buildings" />

<x-modal-add modalTitle="Add building" route="admin.buildings.add" modalId="addBuildingModal" formId="addBuildingForm">
    @csrf
    @if (Auth::user()->role == 'owner')
        <x-input-group name="owner" label="Owner" placeholder="Enter owner" type="text" required="true" readonly="true"
            disabled="true"
            value="{{ Auth::user()->id . ' - ' . Auth::user()->firstName . ' ' . Auth::user()->lastName }}" />
        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
        <input type="hidden" name="status" value="waiting" id="status" />
    @elseif (Auth::user()->role == 'admin')
        <div class="form-group">
            <label for="userNameInput">Select user</label>
            <input type="text" class="form-control" id="userNameInput" name="userNameInput" placeholder="Select user" />
            <input type="hidden" name="user_id" id="user_id" />
            <input type="hidden" name="status" value="active" id="status" />
        </div>
    @endif
    <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" />
    <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true" />
    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true" />
    <x-select-group name="country" label="Country" :options="$listCountry" required="true" />
    <!-- <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true" /> -->
    <x-textarea-group name="map" label="Map" placeholder="Enter map" required="true" />
    <x-input-group name="certificates[]" label="Certificate" placeholder="Enter certificate" type="file"
        required="true" />
</x-modal-add>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#alert-success').fadeOut();
        }, 2000);

        $('input[type="file"]').on('change', function () {
            var files = this.files;
            var images = [];
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (event) {
                    images.push(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<x-admin-table>
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Owner</th>
            <th>Building Name</th>
            <th>Description</th>
            <th>Address</th>
            <th>Country</th>
            <th>Map</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($buildings->isEmpty())
            <p>No buildings found.</p>
        @else
            @foreach ($buildings as $key => $building)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="{{ route('admin.buildings.get', $building->id) }}">{{ $building->id }}</a></td>
                    <td>
                        <a
                            href="{{ route('admin.users.get', $building->user->id) }}">{{ $building->user->firstName . ' ' . $building->user->lastName }}</a>
                    </td>
                    <td>{{ $building->name }}</td>
                    <td>
                        <div
                            style="width: 250px;white-space: normal;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 4;">
                            {{ $building->description }}
                        </div>
                    </td>
                    <td>{{ $building->address }}</td>
                    <td>{{ $building->country }}</td>
                    <td><a href="{{ $building->map }}" title="{{ $building->name }}">Click here to see map</a></td>

                    <td class="status-{{ $building->status }}">{{ $building->status }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-id="{{ $building->id }}"
                            data-action="{{ route('admin.buildings.update', $building->id) }}" data-target="#editBuildingModal">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBuildingModal"
                            data-id="{{ $building->id }}" data-action="{{ route('admin.buildings.destroy', $building->id) }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</x-admin-table>

<div id="alert-container"></div>

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

        $('#userNameInput').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('owner.autocomplete') }}",
                    data: { term: request.term },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.name,
                                value: item.name,
                                id: item.id
                            };
                        }));
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            },
            appendTo: "#addBuildingModal",
            select: function (event, ui) {
                $('#userNameInput').val(ui.item.value);
                $('#user_id').val(ui.item.id);
                return false;
            },
            open: function () {
                $('.ui-autocomplete').css('position', 'absolute');
            }
        });
    });
</script>

<x-modal-edit modalTitle="Edit Building" modalId="editBuildingModal" formId="editBuildingForm">
    <x-input-group name="name" label="Name" placeholder="Enter building name" type="text" required="true" />
    <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true" />
    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true" />
    <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true" />
    <x-textarea-group name="map" label="Map" placeholder="Enter map link or embed code" required="true" />
    <x-input-group name="certificate" label="Certificate" placeholder="Enter certificate" type="file" required="true" />
    <x-select-group name="status" label="Status" placeholder="Enter status" :options="$status" required="true" />
</x-modal-edit>

<x-modal-delete modalId="deleteBuildingModal" formId="deleteBuildingForm" modalTitle="Delete Building">
    <p>Are you sure you want to delete this building?</p>
</x-modal-delete>

<script>


    $('#editBuildingModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var buildingId = button.data('id');
        var actionUrlTemplate = button.data('action');
        var modal = $(this);

        $.get(`/admin/buildings/${buildingId}`, function (building) {
            modal.find('[name="name"]').val(building.name);
            modal.find('[name="description"]').val(building.description);
            modal.find('[name="address"]').val(building.address);
            modal.find('[name="country"]').val(building.country);
            modal.find('[name="map"]').val(building.map);
            modal.find('[name="certificate"]').val(building.certificate);
            modal.find('[name="status"]').val(building.status);
            modal.find('form').attr('action', actionUrlTemplate);
        });
    });

    $('#deleteBuildingModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var buildingId = button.data('id');
        var actionUrlTemplate = button.data('action');
        var modal = $(this);

        modal.find('form').attr('action', actionUrlTemplate);
    });
</script>
@endsection