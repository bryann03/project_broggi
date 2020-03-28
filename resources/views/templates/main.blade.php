<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('titulo')
    </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}
    <script src="https://kit.fontawesome.com/2ebf0d5213.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app" class="container">
        @yield('principal')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
