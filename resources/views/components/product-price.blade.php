@props(['price', 'comparePrice'])

<div class="product-price flex items-center gap-[10px]">
    <span class="price text-title-1 font-bold text-red">
        {{ format_usd($price) }}
    </span>
    @if ($comparePrice)
        <span class="compare-price font-bold text-title-2 text-gray-300 line-through">
            {{ format_usd($comparePrice) }}
        </span>
    @endif
</div>