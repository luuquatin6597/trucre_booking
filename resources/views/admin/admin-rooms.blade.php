@extends('admin.index')
@section('admin')
<div class="relative">
    <x-admin-breadcrumb title="Rooms" subtitle="List rooms" link="admin.rooms" />

    <x-modal-add modalTitle="Add room" route="admin.rooms.add" modalId="varyingModal" formId="varyingForm">
        <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" />

        <div class="flex">
            <x-input-group name="startAt" label="Start At" placeholder="Enter start at" type="date" required="true" />
            <x-input-group name="endAt" label="End At" placeholder="Enter end at" type="date" required="true" />
        </div>
        <x-input-group name="price" label="Price" placeholder="Enter price" type="number" required="true" />
        <x-input-group name="comparePrice" label="Compare Price" placeholder="Enter compare price" type="number"
            required="true" />
        <div class="flex">
            <x-input-group name="weekPrice" label="Week Price" placeholder="Enter week price" type="number"
                required="true" />
            <x-input-group name="monthPrice" label="Month Price" placeholder="Enter month price" type="number"
                required="true" />
            <x-input-group name="yearPrice" label="Year Price" placeholder="Enter year price" type="number"
                required="true" />
        </div>
        <div class="flex">
            <x-input-group name="weekendPrice" label="Weekend Price" placeholder="Enter weekend price" type="number"
                required="true" />
            <x-input-group name="holidayPrice" label="Holiday Price" placeholder="Enter holiday price" type="number"
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
    </x-modal-add>

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
                        <td>{{ $room->images }}</td>
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