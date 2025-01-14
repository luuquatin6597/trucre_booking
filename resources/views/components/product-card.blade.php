<?php
use App\Models\Images;
if ($product->tags != null) {
    $tags = explode(',', $product->tags);
    $hashtags = array_slice($tags, 0, 3);
}
$image = Images::where('room_id', $product->id)->first();
?>

<div class="card-item">
    <a class="product-img relative block overflow-hidden rounded-15 mb-[12px]"
        href="{{ route('room.room', $product->id) }}" title="{{ $product->name }}">

        <!-- <span
            class="absolute flex items-center justify-center px-[8px] py-[4px] gap-[4px] top-[6px] right-[6px] text-white bg-yellow text-body-2 rounded-full">
            @include('components.icons.icon-clock')
            10:05:11
        </span> -->
        <span
            class="absolute bottom-0 left-0 bg-red rounded-tr-15 rounded-bl-15 px-[14px] py-[5px] text-white text-title-2 font-bold">
            {{ calculate_discount(price: $product->price, comparePrice: $product->comparePrice) }}
        </span>
        <img class="block w-full h-[400px] object-cover"
            src="{{ $image != null ? asset($image->url) : 'https://via.placeholder.com/300x200' }}"
            alt="{{ $product->name }}" />
    </a>
    <div class="product-info">
        <a class="product-title text-title-2 font-bold mb-[8px] overflow-hidden text-ellipsis line-clamp-2 whitespace-normal"
            href="{{ route('room.room', $product->id) }}" title="{{ $product->name }}">{{$product->name}}</a>
        <x-product-price price="{{$product->price}}" comparePrice="{{$product->comparePrice}}" />

        @if($product->tags != null)
            @foreach ($hashtags as $hashtag)
                @php
                    $encodedHashtag = urlencode(trim($hashtag));
                    $h = url('/categories?tags=' . $encodedHashtag);
                @endphp
                <x-hashtag href="{{ $h }}" class="mt-[12px] w-fit">
                    #{{ trim($hashtag) }}
                </x-hashtag>
            @endforeach
        @endif
    </div>
</div>