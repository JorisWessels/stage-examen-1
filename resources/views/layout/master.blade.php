<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Joris-Examen</title>

    @section('head')

    @show

    @section('page-css')
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        {{-- page specific css --}}
    @show
</head>
<body>
@section('body')
    @yield('content')
@show
@section('footer')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
    <script src="{{mix('js/app.js')}}"></script>
@show
</body>
</html>
