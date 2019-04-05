@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="edit" action="{{route($route.'.update', $dataName->id)}}" method="post">
    @method('PATCH')
    {{ csrf_field() }}
    @foreach($inputfields as $field)
        @include('form.inputfields.'.$field['type'], $field)
    @endforeach
    <input type="submit" value="Edit">
</form>
