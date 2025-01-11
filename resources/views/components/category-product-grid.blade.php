<div @if(isset($id)) id="{{ $id }}" @endif class="grid-card grid grid-cols-4 gap-24">
    @foreach ($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>
