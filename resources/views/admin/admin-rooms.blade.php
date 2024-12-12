@extends('admin.index')
@section('admin')
<div class="relative">
    <x-admin-breadcrumb title="Rooms" subtitle="List rooms" link="admin.rooms" />

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#varyingModal">Add new</button>

    <x-modal-add />

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Compare Price</th>
                                    <th>Max Chair</th>
                                    <th>Max Table</th>
                                    <th>Max People</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $key => $room)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->price }}</td>
                                        <td>{{ $room->comparePrice }}</td>
                                        <td>{{ $room->maxChair }}</td>
                                        <td>{{ $room->maxTable }}</td>
                                        <td>{{ $room->maxPeople }}</td>
                                        <td>{{ $room->status }}</td>
                                        <td>{{ $room->created_at }}</td>
                                        <td>{{ $room->updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editUserModal{{ $room->id }}"><i
                                                    class="mdi mdi-pencil"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteUserModal{{ $room->id }}"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var varyingModal = document.getElementById('varyingModal')
    varyingModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = varyingModal.querySelector('.modal-title')
        var modalBodyInput = varyingModal.querySelector('.modal-body input')

        modalTitle.textContent = 'New message to ' + recipient
        modalBodyInput.value = recipient
    })
</script>
@endsection