<div class="form-group" id="{{$id}}_{{$name}}">
    <label class="control-label col-sm-2" for="{{$name}}">{{$label}}</label>
    <div class="col-sm-10">
        <input class="form-control" id="{{$id}}_{{$name}}_{{$type}}" type="{{$type}}" name="{{$name}}"
               placeholder="{{$label}}..." value="@isset($value){{$dataName->$value}}@endisset{{old($name)}}">
    </div>
</div>
