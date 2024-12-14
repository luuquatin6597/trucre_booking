@extends('admin.index')
@section('admin')
<x-admin-breadcrumb title="Buildings" subtitle="List Buildings" link="admin.owner-buildings" />
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBuildingModal">Add Building</button>

<!-- Add Building Modal -->
<div class="modal fade" id="addBuildingModal" tabindex="-1" role="dialog" aria-labelledby="addBuildingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBuildingModalLabel">Add Building</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.buildings.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Enter Description" required>
                    </div>
                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="waiting">Waiting</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buildings as $key => $building)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $building->name }}</td>
                                    <td>{{ $building->description }}</td>
                                    <td>{{ $building->address }}</td>
                                    <td>{{ ucfirst($building->status) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#editBuildingModal{{ $building->id }}">Edit</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteBuildingModal{{ $building->id }}">Delete</button>
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