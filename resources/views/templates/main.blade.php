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
   <div id="app">
       <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/img/logoBroggi.png')}}" height="50" alt="logo">
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                </ul>
                <ul class="navbar-nav text-right m-4">
                    {{-- Idioma --}}
                    <li class="nav-item dropdown ">
                        
                    </li>

                </ul>
                <ul class="navbar-nav text-right">
                    @if (Auth::check())
                    <li class="nav-item dropdown btn btn-outline-danger">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->nom}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('logout')}}">Leave</a>

                        </div>
                    </li>


                    @else

                    <!--<a href="{{--route('login')--}}"><button class="btn btn-outline-success my-2 my-sm-0">LOGIN</button></a>-->

                    @endif
                </ul>


            </div>
        </nav>

    <div class="container">
        @yield('principal')
    </div>
   </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>