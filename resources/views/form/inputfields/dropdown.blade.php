<div class="form-group" id="{{$id}}_{{$name}}">
    <label class="control-label col-sm-2" for="{{$name}}">{{$label}}</label>
    <div class="col-sm-10">
        <select class="form-control" name="{{$name}}" id="{{$id}}_{{$name}}_{{$type}}">
            <option value selected="selected">Choose an option</option>
            @if(isset($value))
                @foreach($data as $item)
                    @if(intval($dataName->$value) === $item->id)
                        <option selected value="{{$item->id}}">{{$item->$key}}</option>
                    @else
                        <option value="{{$item->id}}">{{$item->$key}}</option>
                    @endif
                @endforeach
            @else
                @foreach($data as $item)
                    <option value="{{$item->id}}">{{$item->$key,45}}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
