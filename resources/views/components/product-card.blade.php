<div class="card-item">
    <a class="product-img relative block overflow-hidden rounded-15 mb-[12px]" href="{{ route('homepage')}}"
        title="Product Name">
        <span
            class="absolute flex items-center justify-center px-[8px] py-[4px] gap-[4px] top-[6px] right-[6px] text-white bg-yellow text-body-2 rounded-full">
            @include('components.icons.icon-clock')
            10:05:11
        </span>
        <span
            class="absolute bottom-0 left-0 bg-red rounded-tr-15 rounded-bl-15 px-[14px] py-[5px] text-white text-title-2 font-bold">
            {{ calculate_discount(price: 1000, comparePrice: 2000) }}
        </span>
        <img class="block w-full h-[400px] object-cover" src="https://via.placeholder.com/300x200" alt="Product Name" />
    </a>
    <div class="product-info">
        <a class="product-title text-title-2 font-bold mb-[8px] overflow-hidden text-ellipsis line-clamp-2 whitespace-normal"
            href="{{ route('homepage')}}" title="Product Name">Product
            Name</a>
        <x-product-price price="1000" comparePrice="2000" />
        <x-hashtag class="mt-[12px] w-fit">
            #da_nang
        </x-hashtag>
    </div>
</div>