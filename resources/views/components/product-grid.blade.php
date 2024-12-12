<div class="pb-100">
    <div class="container">
        <div class="title-group flex items-center justify-between pb-24">
            <h3 class="flex items-center gap-20 font-bold text-heading-3 text-primary-400">
                <img class="w-[40px] h-[40px]" src="{{ asset('assets/img/' . $icon . '.png') }}" alt="Meeting room">
                {{  $title }}
            </h3>
            <a class="flex items-center justify-center gap-[8px] text-primary-400 border border-primary-400 rounded-full py-[10px] w-[120px] hover:shadow-[0px_0px_20px_0px_rgba(251,130,0,0.6)] transition ease-in-out duration-200 hover:bg-primary-400 hover:text-white"
                href="{{ $href }}" title="Meeting room">
                See all
            </a>
        </div>
        <div class="grid-card grid grid-cols-4 gap-24">
            @foreach ($products as $product)
                <x-product-card />
            @endforeach
        </div>
    </div>
</div>