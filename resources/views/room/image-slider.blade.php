<script>
    $(document).ready(function () {
        $('.variable-width').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true,
            prevArrow: '<button type="button" class="slick-prev absolute left-[12px] top-[50%] translate-y-[-50%] w-[50px] h-[50px] bg-white rounded-full z-[1] flex items-center justify-center"><svg class="w-full h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path class="fill-primary-300" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg></button>',
            nextArrow: '<button type="button" class="slick-next absolute right-[12px] top-[50%] translate-y-[-50%] w-[50px] h-[50px] bg-white rounded-full z-[1] flex items-center justify-center"><svg class="w-full h-[25px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path class="fill-primary-300" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg></button>'
        });
    });
</script>


<?php
use App\Models\Images;
$images = Images::where('room_id', $room->id)->get();
?>
<div class="variable-width mt-[140px]">
    @foreach ($images as $image)
        <div>
            <img class="h-[400px]" src="{{ asset($image->url) }}" alt="" />
        </div>
    @endforeach
</div>