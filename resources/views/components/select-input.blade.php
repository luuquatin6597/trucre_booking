<select
    @if($attributes->has('name')) name="{{ $attributes->get('name') }}" @endif
    @if($attributes->has('id')) id="{{ $attributes->get('id') }}" @endif
    class="block h-[50px] text-body-1 rounded-full bg-gray-100 px-4 py-2 border-none outline-none {{ $attributes->get('class') }}">
    @foreach($options as $option)
        <option value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
