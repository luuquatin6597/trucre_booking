<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <textarea class="form-control" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" {{ $required == 'true' || $required == true ? 'required' : '' }}></textarea>
</div>