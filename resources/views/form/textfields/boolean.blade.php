<div class="form-group" id="{{$id}}_{{$name}}">
    <h3>{{$label}}</h3>
    <div class="col-sm-10">
        @if($dataName->$value)
            <p class="form-control" id="{{$id}}_{{$name}}_{{$type}}">{{'Yes'}}</p>
        @else
            <p class="form-control" id="{{$id}}_{{$name}}_{{$type}}">{{'No'}}</p>
        @endif
    </div>
</div>
