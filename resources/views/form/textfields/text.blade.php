<div class="form-group" id="{{$id}}_{{$name}}">
    <h3>{{$label}}</h3>
    <div class="col-sm-10">
        @if(isset($relation))
            <p class="form-control" id="{{$id}}_{{$name}}_{{$type}}">{{$dataName->$relation->$value}}</p>
        @else
            @if($dataName->$value === null)
                <p class="form-control" id="{{$id}}_{{$name}}_{{$type}}">-</p>
            @else
                <p class="form-control" id="{{$id}}_{{$name}}_{{$type}}">{{$dataName->$value}}</p>
            @endif
        @endif
    </div>
</div>
