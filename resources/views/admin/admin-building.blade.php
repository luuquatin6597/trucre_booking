@extends('admin.index')

@section('admin')
<x-admin-breadcrumb title="Buildings" subtitle="Add new building" link="admin.buildings" />

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBuildingModal">Add Building</button>

<div class="modal fade" id="addBuildingModal" tabindex="-1" role="dialog" aria-labelledby="addBuildingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBuildingModalLabel">Add New Building</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Building Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter building name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" required>
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
                        <label for="map">Map</label>
                        <input type="text" class="form-control" id="map" name="map" placeholder="Enter map location" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Building</button>
                    </div>
                </form>
            </div>
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
    @foreach ($buildings as $building)
        <tr>
            <td>{{ $building->id }}</td>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
