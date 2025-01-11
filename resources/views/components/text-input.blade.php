@props([
    'disabled' => false,
    'name' => null,
    'placeholder' => null,
    'required' => false,
    'type' => 'text',
    'value' => null,
])

<input id="{{$name}}" name="{{$name}}" type="{{$type}}" placeholder="{{$placeholder}}" value="{{ $value }}"
    @required($required) @disabled($disabled) {{ $attributes->merge(['class' => 'block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none']) }}>