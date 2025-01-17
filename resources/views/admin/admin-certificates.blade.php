@extends('admin.index')

@section('admin')
<?php
$status = ['accepted' => 'accepted', 'rejected' => 'rejected'];
?>
<x-admin-breadcrumb title="Certificates" subtitle="Manage Building Certificates" link="admin.certificates" />
<x-admin-table>
    <thead>
        <tr>
            <th>#</th>
            <th>Building ID</th>
            <th>Certificate</th>
            <th>Action</th>
            <th>Building Status</th>
        </tr>
    </thead>
    <tbody>
        @if ($certificates->isEmpty())
            <tr>
                <td colspan="6">No certificates found.</td>
            </tr>
        @else
            @foreach ($certificates as $key => $certificate)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="{{ route('admin.buildings.get', $certificate->building->id) }}"
                            title="{{ $certificate->building->name }}">{{ $certificate->building_id }}</a></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#certificateModal"
                            data-url="{{ asset($certificate->url) }}">View Certificate</button>
                    </td>
                    <td class="status-{{ $certificate->building->status }}">{{ $certificate->building->status }}</td>
                    <td>
                        <form action="{{ route('admin.certificates.accept', $certificate->building->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                        </form>
                        <form action="{{ route('admin.certificates.reject', $certificate->building->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</x-admin-table>

<div id="alert-container"></div>

<!-- Modal -->
<div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateModalLabel">Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="certificateImage" src="" alt="Certificate" class="img-fluid">
                <embed id="certificateEmbed" src="" type="application/pdf" width="100%" height="600px">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
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

        $('#certificateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var certificateUrl = button.data('url');
            var fileExtension = certificateUrl.split('.').pop().toLowerCase();


            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                $('#certificateImage').attr('src', certificateUrl).removeClass('d-none');
                $('#certificateEmbed').addClass('d-none');
            } else if (fileExtension === 'pdf') {
                $('#certificateEmbed').attr('src', certificateUrl).removeClass('d-none');
                $('#certificateImage').addClass('d-none');
            } else {
                alert('Unsupported file format');
                $('#certificateImage').addClass('d-none');
                $('#certificateEmbed').addClass('d-none');
            }
        });
    });
</script>


@endsection