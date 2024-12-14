<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <select class="form-control" id="{{$name}}" name="{{$name}}" required>
        @foreach ($options as $option)
            <option value="{{$option}}">{{$option}}</option>
        @endforeach
    </select>
</div>