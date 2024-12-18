@extends('admin.index')

@section('admin')
<x-admin-breadcrumb title="Buildings" subtitle="Add new building" link="admin.buildings" />

<x-modal-add modalTitle="Add building" route="admin.buildings.add" modalId="addBuildingModal" formId="addBuildingForm">
    <!-- <x-input-group name="userNameInput" label="User Name" placeholder="Enter user name" type="text" required="true" />
    <input type="hidden" name="user_id" id="userIdInput" /> -->

    <x-input-group name="owner" label="Owner" placeholder="Enter owner" type="text" required="true" readonly="true"
        disabled="true"
        value="{{ Auth::user()->id . ' - ' . Auth::user()->firstName . ' ' . Auth::user()->lastName }}" />
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
    <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" value="FPT Building" />
    <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true"
        value="Phổ thông Cao đẳng FPT Polytechnic Đà Nẵng" />
    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true"
        value="137 Đường Nguyễn Thị Thập, Thanh Khê Tây, Liên Chiểu, Đà Nẵng" />
    <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true"
        value="Việt Nam" />
    <x-textarea-group name="map" label="Map" placeholder="Enter map" required="true" value="This is map" />
    <input type="hidden" name="status" value="waiting" id="status" />
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

<div id="alert-container"></div>

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

        function showAlert(type, message) {
            var alert = `<div class="fixed bottom-1 right-1 alert alert-${type} alert-dismissible fade show" role="alert">
                    <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
                    <button type="button" class="btn-close py-0 h-100" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>`;
            $('#alert-container').html(alert); // Thêm alert vào container
            setTimeout(function () {
                $('.alert').alert('close'); // Đóng alert sau 5 giây
            }, 5000);
        }
    });
</script>

@endsection