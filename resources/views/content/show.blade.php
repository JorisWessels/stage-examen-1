@foreach($categories as $category)
    <h1>{{$category['title']}}</h1>
    @foreach($category['fields'] as $field)
        @include('form.textfields.'.$field['type'], $field)
    @endforeach
@endforeach
