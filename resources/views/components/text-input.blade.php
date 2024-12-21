@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none']) }}>