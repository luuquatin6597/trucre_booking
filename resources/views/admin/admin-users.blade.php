@extends('admin.index')
@section('admin')
<?php
$gender = ['male' => 'male', 'female' => 'female'];
$status = ['active' => 'active', 'inactive' => 'inactive'];
$role = ['admin' => 'admin', 'user' => 'user', 'staff' => 'staff', 'owner' => 'owner'];
?>

<x-admin-breadcrumb title="Users" subtitle="List users" link="admin.users" />

<x-modal-add modalTitle="Add user" route="admin.users.add" modalId="addUserModal" formId="addUserForm">
    <x-input-group name="firstName" label="First Name" placeholder="Enter first name" type="text" required="true" />

    <x-input-group name="lastName" label="Last Name" placeholder="Enter last name" type="text" required="true" />

    <x-input-group name="dayOfBirth" label="Day of Birth" placeholder="Enter Day of Birth" type="date"
        required="true" />

    <x-select-group name="gender" label="Gender" :options="$gender" required="true" />

    <x-input-group name="email" label="Email" placeholder="Enter email" type="text" required="true" />

    <x-input-group name="phone" label="Phone" placeholder="Enter phone" type="text" required="true" />

    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true" />

    <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true" />

    <x-input-group name="username" label="Username" placeholder="Enter username" type="text" required="true" />

    <x-select-group name="role" label="Role" :options="$role" required="true" />

    <x-select-group name="status" label="Status" :options="$status" required="true" />

    <x-input-group name="password" label="Password" placeholder="Enter password" type="password" required="true" />
</x-modal-add>

<x-admin-table>
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Day of birth</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Email verified at</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Country</th>
            <th>Username</th>
            <th>Role</th>
            <th>Point</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($users->isEmpty())
            <p>No buildings found.</p>
        @else
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->dayOfBirth }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->country }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->point }}</td>
                    <td class="status-{{ $user->status }}">{{ $user->status }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-id="{{ $user->id }}"
                            data-action="{{ route('admin.users.update', $user->id) }}" data-target="#editUserModal">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal"
                            data-id="{{ $user->id }}" data-action="{{ route('admin.users.destroy', $user->id) }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</x-admin-table>

<x-modal-edit modalTitle="Edit user" modalId="editUserModal" formId="editUserForm">
    <x-input-group name="firstName" label="First Name" placeholder="Enter first name" type="text" required="true" />

    <x-input-group name="lastName" label="Last Name" placeholder="Enter last name" type="text" required="true" />

    <x-input-group name="dayOfBirth" label="Day of Birth" placeholder="Enter Day of Birth" type="date"
        required="true" />

    <x-select-group name="gender" label="Gender" :options="$gender" required="true" />

    <x-input-group name="email" label="Email" placeholder="Enter email" type="text" required="true" />

    <x-input-group name="phone" label="Phone" placeholder="Enter phone" type="text" required="true" />

    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true" />

    <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true" />

    <x-input-group name="username" label="Username" placeholder="Enter username" type="text" required="true" />

    <x-select-group name="role" label="Role" :options="$role" required="true" />

    <x-select-group name="status" label="Status" :options="$status" required="true" />

    <x-input-group name="password" label="Password" placeholder="Enter password" type="password" required="true" />
</x-modal-edit>

<div id="alert-container"></div>

<x-modal-delete modalId="deleteUserModal" formId="deleteUserForm" modalTitle="Delete user"></x-modal-delete>

<script>
    $('#editUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Nút được nhấn
        var userId = button.data('id'); // ID của user
        var actionUrlTemplate = button.data('action');
        var modal = $(this);

        // Gửi request để lấy thông tin user
        $.get(`/admin/users/${userId}`, function (user) {
            // Điền thông tin user vào form
            console.log(user)
            var dayOfBirth = user.dayOfBirth.split(' ')[0];

            modal.find('[name="firstName"]').val(user.firstName);
            modal.find('[name="lastName"]').val(user.lastName);
            modal.find('[name="dayOfBirth"]').val(dayOfBirth);
            modal.find('[name="gender"]').val(user.gender);
            modal.find('[name="email"]').val(user.email);
            modal.find('[name="phone"]').val(user.phone);
            modal.find('[name="address"]').val(user.address);
            modal.find('[name="country"]').val(user.country);
            modal.find('[name="username"]').val(user.username);
            modal.find('[name="role"]').val(user.role);
            modal.find('[name="status"]').val(user.status);
            // Cập nhật action cho form
            modal.find('form').attr('action', actionUrlTemplate);
        });
    });

    $('#editUserForm').submit(function (event) {
        event.preventDefault(); // Ngăn submit form mặc định

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (response) {
                $('#editUserModal').hide()
                $('.modal-backdrop').remove()
                $('body').removeClass('modal-open');
                showAlert('success', 'User updated successfully.');
            },
            error: function (xhr) {
                $('#editUserModal').modal('hide')
                var error = xhr.responseJSON?.message || 'An error occurred!';
                showAlert('danger', error);
            }
        });
    });

    $('#deleteUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Nút được nhấn
        var userId = button.data('id'); // ID của user
        var actionUrlTemplate = button.data('action');
        var modal = $(this);

        modal.find('form').attr('action', actionUrlTemplate);
    })

    $('#deleteUserForm').submit(function (event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (response) {
                $('#deleteUserModal').hide()
                $('.modal-backdrop').remove(); // Xóa backdrop
                $('body').removeClass('modal-open');
                showAlert('success', 'User deleted successfully.');
            },
            error: function (xhr) {
                $('#deleteUserModal').modal('hide');
                var error = xhr.responseJSON?.message || 'An error occurred!';
                showAlert('danger', error);
            }
        });
    });

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
</script>
@endsection