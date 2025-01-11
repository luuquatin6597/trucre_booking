@props(['disabled' => false,
'name'=> null,
'placeholder' => null])

<input id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" @disabled($disabled) {{ $attributes->merge(['class' => 'block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none']) }}>
