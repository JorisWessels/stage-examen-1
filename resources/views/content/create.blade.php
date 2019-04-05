@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="create" action="{{ route($route.'.store') }}" method="post">
    {{ csrf_field() }}
    @foreach($inputfields as $field)
        @include('form.inputfields.'.$field['type'], $field)
    @endforeach
    <input type="submit" value="Create">
</form>
