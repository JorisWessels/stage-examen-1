@extends('layout.master')
@section('main-content')
    <div>
        <a href="{{URL::to($route)}}">
            <button class="btn-primary">Back</button>
        </a>
    </div>
    @foreach($categories as $category)
        <h1>{{$category['title']}}</h1>
        @foreach($category['fields'] as $field)
            @include('form.textfields.'.$field['type'], $field)
        @endforeach
    @endforeach
@endsection
