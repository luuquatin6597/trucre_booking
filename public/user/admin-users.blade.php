@extends('admin.index')
@section('admin')
<x-admin-breadcrumb title="Users" subtitle="List users" link="admin.users" />
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Add user</button>
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.users.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" required>
                </div>
                <div class="form-group">
                    <label for="dayOfBirth">Day of Birth</label>
                    <input type="date" class="form-control" id="dayOfBirth" name="dayOfBirth" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option>male</option>
                        <option>female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option>admin</option>
                        <option>user</option>
                        <option>staff</option>
                        <option>owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option>active</option>
                        <option>inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>

                 <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
            </form>

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

      </div>
    </div>
<script>
    document.querySelector('#saveButton').addEventListener('click', function() {
    this.disabled = true;
    this.textContent = 'Saving...';
});
</script>
  </div>
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
                                    <td>{{ $user->status }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#editUserModal{{ $user->id }}">Edit<i
                                            class="mdi mdi-pencil"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal_{{ $user->id }}">
                                                Delete
                                            </button>

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
@foreach($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $user->firstName }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}" required>
                    </div>
                  <div class="form-group">
                      <label for="dayOfBirth">Day of Birth</label>
                      <input type="text" class="form-control" id="dayOfBirth" name="dayOfBirth" value="{{ $user->dayOfBirth }}" required>
                  </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($users as $user)
<div class="modal fade" id="deleteUserModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

{{-- @extends('admin.index')

@section('admin')
<x-admin-breadcrumb title="Buildings" subtitle="Add new building" link="admin.buildings" />

<x-modal-add modalTitle="Add Building" route="admin.buildings.add" modalId="addBuildingModal" formId="addBuildingForm">
    <x-input-group name="name" label="Name" placeholder="Enter building name" type="text" required="true" />
    <x-textarea-group name="description" label="Description" placeholder="Enter building description" required="true" />
    <x-input-group name="address" label="Address" placeholder="Enter building address" type="text" required="true" />
    <x-input-group name="country" label="Country" placeholder="Enter building country" type="text" required="true" />
    <x-textarea-group name="map" label="Map" placeholder="Enter building map" required="true" />
</x-modal-add>

<x-admin-table>
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Owner</th>
            <th>Name</th>
            <th>Description</th>
            <th>Address</th>
            <th>Country</th>
            <th>Map</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($buildings as $key => $building)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $building->id }}</td>
                <td>
                    <a href="{{ route('admin.users.get', $building->user->id) }}">
                        {{ $building->user->fullName }}
                    </a>
                </td>
                <td>{{ $building->name }}</td>
                <td>{{ $building->description }}</td>
                <td>{{ $building->address }}</td>
                <td>{{ $building->country }}</td>
                <td>{{ $building->map }}</td>
                <td>{{ $building->status }}</td>
                <td>
                    <button class="btn btn-info btn-sm edit-building" data-id="{{ $building->id }}" data-bs-toggle="modal" data-bs-target="#editBuildingModal">Edit</button>
                    <button class="btn btn-danger btn-sm delete-building" data-id="{{ $building->id }}" data-bs-toggle="modal" data-bs-target="#deleteBuildingModal">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">No buildings found.</td>
            </tr>
        @endforelse
    </tbody>
</x-admin-table>

<x-modal-edit modalTitle="Edit Building" modalId="editBuildingModal" formId="editBuildingForm">
    <x-input-group name="name" label="Name" placeholder="Enter name" type="text" required="true" />
    <x-textarea-group name="description" label="Description" placeholder="Enter description" required="true" />
    <x-input-group name="address" label="Address" placeholder="Enter address" type="text" required="true" />
    <x-input-group name="country" label="Country" placeholder="Enter country" type="text" required="true" />
    <x-textarea-group name="map" label="Map" placeholder="Enter map" required="true" />
</x-modal-edit>

<x-modal-delete modalId="deleteBuildingModal" formId="deleteBuildingForm" modalTitle="Delete Building">
    Are you sure you want to delete this building?
</x-modal-delete>

<div id="alert-container"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const showAlert = (type, message) => {
            const alertContainer = document.getElementById('alert-container');
            alertContainer.innerHTML = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                                            <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                         </div>`;
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) alert.remove();
            }, 5000);
        };

        // Edit Modal Setup
        document.querySelectorAll('.edit-building').forEach(button => {
            button.addEventListener('click', async (event) => {
                const buildingId = event.currentTarget.dataset.id;
                const response = await fetch(`/admin/buildings/${buildingId}`);
                const building = await response.json();

                const editModal = document.getElementById('editBuildingModal');
                const form = editModal.querySelector('form');
                form.action = `/admin/buildings/update/${buildingId}`;

                form.querySelector('input[name="name"]').value = building.name;
                form.querySelector('textarea[name="description"]').value = building.description;
                form.querySelector('input[name="address"]').value = building.address;
                form.querySelector('input[name="country"]').value = building.country;
                form.querySelector('textarea[name="map"]').value = building.map;
            });
        });

        // Delete Modal Setup
        document.querySelectorAll('.delete-building').forEach(button => {
            button.addEventListener('click', (event) => {
                const buildingId = event.currentTarget.dataset.id;
                const deleteModal = document.getElementById('deleteBuildingModal');
                deleteModal.querySelector('form').action = `/admin/buildings/delete/${buildingId}`;
            });
        });

        // AJAX Form Submission
        const handleFormSubmission = (formId, modalId) => {
            const form = document.getElementById(formId);
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const modal = document.getElementById(modalId);
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    modal.querySelector('.btn-close').click();
                    showAlert('success', 'Operation completed successfully.');
                } else {
                    showAlert('danger', 'An error occurred during the operation.');
                }
            });
        };

        handleFormSubmission('editBuildingForm', 'editBuildingModal');
        handleFormSubmission('deleteBuildingForm', 'deleteBuildingModal');
    });
</script>
@endsection --}}

