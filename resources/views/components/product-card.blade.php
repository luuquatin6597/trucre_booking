<?php
use App\Models\Images;
use App\Models\Buildings;
if ($product->tags != null) {
    $tags = explode(',', $product->tags);
    $hashtags = array_slice($tags, 0, 3);
}
$image = Images::where('room_id', $product->id)->first();
$location = Buildings::where('id', $product->building_id)->first();
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

        <x-hashtag href="{{ route('categories.index', ['country' => $location['country']]) }}"
            class="location mt-[12px] gap-[10px] w-fit">
            {{ $location['country'] }}
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 0C6.41484 0 6.75 0.335156 6.75 0.75V1.56328C8.63437 1.87734 10.1227 3.36562 10.4367 5.25H11.25C11.6648 5.25 12 5.58516 12 6C12 6.41484 11.6648 6.75 11.25 6.75H10.4367C10.1227 8.63437 8.63437 10.1227 6.75 10.4367V11.25C6.75 11.6648 6.41484 12 6 12C5.58516 12 5.25 11.6648 5.25 11.25V10.4367C3.36562 10.1227 1.87734 8.63437 1.56328 6.75H0.75C0.335156 6.75 0 6.41484 0 6C0 5.58516 0.335156 5.25 0.75 5.25H1.56328C1.87734 3.36562 3.36562 1.87734 5.25 1.56328V0.75C5.25 0.335156 5.58516 0 6 0ZM3 6C3 6.79565 3.31607 7.55871 3.87868 8.12132C4.44129 8.68393 5.20435 9 6 9C6.79565 9 7.55871 8.68393 8.12132 8.12132C8.68393 7.55871 9 6.79565 9 6C9 5.20435 8.68393 4.44129 8.12132 3.87868C7.55871 3.31607 6.79565 3 6 3C5.20435 3 4.44129 3.31607 3.87868 3.87868C3.31607 4.44129 3 5.20435 3 6ZM6 4.125C6.49728 4.125 6.97419 4.32254 7.32583 4.67417C7.67746 5.02581 7.875 5.50272 7.875 6C7.875 6.49728 7.67746 6.97419 7.32583 7.32583C6.97419 7.67746 6.49728 7.875 6 7.875C5.50272 7.875 5.02581 7.67746 4.67417 7.32583C4.32254 6.97419 4.125 6.49728 4.125 6C4.125 5.50272 4.32254 5.02581 4.67417 4.67417C5.02581 4.32254 5.50272 4.125 6 4.125Z"
                    fill="#34C759" />
            </svg>
        </x-hashtag>
    </div>
</div>