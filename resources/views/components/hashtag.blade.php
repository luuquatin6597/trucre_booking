<a href="{{ $attributes->get('href', '#') }}" {{ $attributes->merge(['class' => 'flex items-center justify-center bg-white rounded-full border border-green text-green py-[6px] px-[10px] font-body-1 hover:bg-green hover:text-white transition ease-in-out duration-200']) }}>
    {{ $slot }}
</a>