<div class="form-group" id="{{$id}}_{{$name}}">
    <label class="control-label col-sm-2" for="{{$name}}">{{$label}}</label>
    <div class="col-sm-10">
        <label class="switch switch-success mr-3">
            @if(isset($value))
                @if($dataName->$value === 1)
                    <input type="hidden" value="0" name="{{$name}}">
                    <input type="{{$type}}" value="1" name="{{$name}}" id="{{$id}}_{{$name}}_{{$type}}" checked>
                @else
                    <input type="hidden" value="0" name="{{$name}}">
                    <input type="{{$type}}" value="1" name="{{$name}}" id="{{$id}}_{{$name}}_{{$type}}">
                @endif
            @else
                <input type="hidden" value="0" name="{{$name}}">
                <input type="{{$type}}" value="1" name="{{$name}}" id="{{$id}}_{{$name}}_{{$type}}">
            @endif
        </label>
    </div>
</div>
