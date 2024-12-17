@extends('admin.index')

@section('admin')
<x-admin-breadcrumb title="Buildings" subtitle="Add new building" link="admin.buildings" />

<x-modal-add modalTitle="Add building" route="admin.users.add" modalId="addBuildingModal" formId="addBuildingForm">
    <!-- <x-input-group name="userNameInput" label="User Name" placeholder="Enter user name" type="text" required="true" />
    <input type="hidden" name="user_id" id="userIdInput" /> -->

    <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" />
    <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true" />
    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true" />
    <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true" />
    <x-textarea-group name="map" label="Map" placeholder="Enter map" required="true" />
</x-modal-add>

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
                    <td>{{ $building->id }}</td>
                    <td>
                        <a
                            href="{{ route('admin.users.get', $building->user->id) }}">{{ $building->user->firstName . ' ' . $building->user->lastName }}</a>
                    </td>
                    <td>{{ $building->name }}</td>
                    <td>{{ $building->description }}</td>
                    <td>{{ $building->address }}</td>
                    <td>{{ $building->country }}</td>
                    <td>{{ $building->map }}</td>
                    <td>{{ $building->status }}</td>
                    <td>
                        <button type="button" class="btn btn-info">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</x-admin-table>

<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
    $(document).ready(function () {
        $('#userNameInput').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('admin.owner.autocomplete') }}",
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
                        console.log(request)
                        console.error(error);
                    }
                });
            },
            appendTo: "#addBuildingModal",
            select: function (event, ui) {
                $('#userNameInput').val(ui.item.value);
                $('#userIdInput').val(ui.item.id);
                return false;
            },
            open: function () {
                $('.ui-autocomplete').css('position', 'absolute'); // Đảm bảo danh sách gợi ý nằm đúng vị trí
            }
        });
    });
</script>

@endsection