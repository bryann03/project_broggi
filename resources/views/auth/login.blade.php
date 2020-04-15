@extends('templates.main')

@section('titulo')
Log in
@endsection

@section('principal')
<div class="row">
    <div class="col-2 col-lg-4 col-md-3"></div>
    <div class="col-8 col-lg-4 col-md-6 text-center">
        <form action="{{action('Auth\LoginController@login')}}" method="POST">
            @csrf
            <div>
                <label class="float-left">User</label>
                <input required class="form-control" name="codi" type="text" value="{{old('codi')}}" />
            </div>

            <div class="mt-3 mb-4">
                <label class="float-left">Password</label>
                <input required class="form-control" name="password" type="password" value="{{old('password')}}" />
            </div>

            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            <a href="{{route('registro')}}"><button class="btn btn-outline-dark my-2 my-sm-0">Registrarse</button></a>
        </form>
    </div>
    <div class="col-2 col-lg-4 col-md-3"></div>
</div>

@endsection
