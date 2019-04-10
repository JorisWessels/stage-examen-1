@if(isset($relation))
    <td>{{$dataName->$relation->$value}}</td>
@else
    @if($dataName->$value === null)
        <td>-</td>
    @else
        <td>{{$dataName->$value}}</td>
    @endif
@endif

