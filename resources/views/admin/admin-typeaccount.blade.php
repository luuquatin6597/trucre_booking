@extends('admin.index')

@section('admin')
<x-admin-breadcrumb title="Users" subtitle="Classify Users by Role" link="admin.typeaccount" />
<div class="div">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($users as $role => $roleUsers)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $role }}" data-toggle="tab"
                    href="#{{ $role }}" role="tab" aria-controls="{{ $role }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ ucfirst($role) }} Users</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach ($users as $role => $roleUsers)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $role }}" role="tabpanel"
                aria-labelledby="tab-{{ $role }}">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableExample-{{ $role }}" class="table">
                                        <thead>
                                            <tr>
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
                                            @foreach ($roleUsers as $key => $user)
                                                <tr>
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
                                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                            data-target="#editUserModal{{ $user->id }}">Edit<i
                                                                class="mdi mdi-pencil"></i></button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteUserModal_{{ $user->id }}">
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
            </div>
        @endforeach
    </div>
</div>
@foreach ($users as $role => $roleUsers)
    <script>
        $(document).ready(function () {
            $('#dataTableExample-{{ $role }}').DataTable();
        });
    </script>
@endforeach
@endsection
