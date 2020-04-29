@extends('templates.main')

@section('titulo')
Log in
@endsection

@section('principal')
<section>
  <div class="m-5 text-center">

    <div class="row">
        <div class="col-2 col-lg-4 col-md-3"></div>
        <div class="col-8 col-lg-4 col-md-6 text-center">
            <form action="{{action('Auth\LoginController@login')}}" method="POST">
              @csrf
              <img class="mb-4" src="{{asset('storage/img/logoBroggi.png')}}" alt="" width="120" height="auto">
              <h1 class="h3 mb-3 font-weight-normal">Log in</h1>

              <input required class="form-control mb-3" name="codi" type="text" placeholder="Nom" />

              <input required class="form-control mb-3" name="password" type="password" placeholder="Codi" />

              <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Iniciar Sesión</button>
            </form>
        </div>
        <div class="col-2 col-lg-4 col-md-3"></div>

      </div>

    <a href="{{route('registro')}}"><button class="btn btn-outline-dark my-2 my-sm-0">Registrarse</button></a>


    <p class="mt-3 mb-3 text-muted">&copy;2020</p>

  </div>
</section>
@endsection