@props(['price', 'comparePrice', 'class'])

<div class="product-price {{ $class ?? '' }} flex items-center gap-[10px]">
    <span class="price text-title-1 font-bold text-red">
        {{ format_currency($price * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
    </span>
    @if ($comparePrice)
        <span class="compare-price font-bold text-title-2 text-gray-300 line-through">
            {{ format_currency($comparePrice * getExchangeRate('USD', session('currency') ?? 'USD'), session('currency') ?? 'USD') }}
        </span>
    @endif
</div>