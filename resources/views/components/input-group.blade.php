<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <input type="{{$type}}" class="form-control" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"
        {{ $required == 'true' || $required == true ? 'required' : '' }}
        {{ isset($readonly) && ($readonly == 'true' || $readonly == true) ? 'readonly' : '' }}
        {{ isset($disabled) && ($disabled == 'true' || $disabled == true) ? 'disabled' : '' }}
        value="{{ isset($value) ? $value : '' }}" />
</div>