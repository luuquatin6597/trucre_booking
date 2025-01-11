<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$modalId}}">{{$modalTitle}}</button>

<div class="modal fade" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="{{$modalId . 'Label'}}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$modalId . 'Label'}}">{{$modalTitle}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body relative">
                <form id="{{$formId}}" action="{{ route($route) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{$slot}}
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button form="{{$formId}}" type="submit" class="btn btn-primary">Add</button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
