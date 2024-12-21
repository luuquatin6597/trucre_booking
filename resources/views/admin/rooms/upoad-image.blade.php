<form action="{{ route('admin.rooms.store', $room->id) }}" method="POST" enctype="multipart/form-data">
    {{ route('admin.rooms.store', $room->id) }}
    @csrf
    <p>This is room name: {{ $room->name }}</p>
    <div class="form-group">
        <label for="images">Upload image</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple placeholder="Select image" />
    </div>
    <button type="submit">Upload</button>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function () {
        $('input[type="file"]').on('change', function () {
            var files = this.files;
            var images = [];
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (event) {
                    images.push(event.target.result);
                    $('#image-list').html('');
                    $.each(images, function (index, image) {
                        $('#image-list').append('<img src="' + image + '" style="max-width: 100px; height: 100px; object-fit: cover;">');
                    });
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<div id="image-list"></div>

<div style="display: flex" class="flex flex-nowrap gap-2">
    @foreach ($images as $image)
        <img style="display:block; max-width: 100px; height: 100px; object-fit: cover;" src="{{ asset($image->url) }}"
            alt="">

        <form action="{{ route('admin.rooms.remove', $image->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">
                Delete
            </button>
        </form>
    @endforeach
</div>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif