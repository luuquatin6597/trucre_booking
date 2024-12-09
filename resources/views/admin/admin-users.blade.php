@extends('admin.index')
@section('admin')
<x-admin-breadcrumb title="Users" subtitle="List users" link="admin.users" />
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editUserModal{{ $user->id }}"><i
                                                class="mdi mdi-pencil"></i></button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteUserModal{{ $user->id }}"><i
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
@endsection