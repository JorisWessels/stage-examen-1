@extends('layout.master')
@section('main-content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <a href="{{URL::to($route)}}">
            <button class="btn-primary">Back</button>
        </a>
    </div>
    <form name="create" action="{{ route($route.'.store') }}" method="post">
        {{ csrf_field() }}
        @foreach($inputfields as $field)
            @include('form.inputfields.'.$field['type'], $field)
        @endforeach
        <input class="btn btn-primary" type="submit" value="Create">
    </form>
@endsection
