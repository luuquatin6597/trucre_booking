@props(['type', 'name'])

<button type="{{ $type ?? 'button' }}" name="{{ $name ?? '' }}" {{ $attributes->merge(['class' => 'btn flex items-center justify-center h-[50px] gap-[10px] px-12 border border-primary-400 rounded-full font-title-2 text-white font-bold bg-primary-400 uppercase tracking-widest hover:shadow-[0px_0px_20px_0px_rgba(251,130,0,0.6)] transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>