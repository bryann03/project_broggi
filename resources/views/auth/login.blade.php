@extends('templates.main')

@section('titulo')
Log in
@endsection

@section('principal')
<section>
  <div class="m-5 text-center">
    <form action="{{action('Auth\LoginController@login')}}" method="POST">
      @csrf
      <img class="mb-4" src="{{asset('storage/img/logoBroggi.png')}}" alt="" width="120" height="auto">
      <h1 class="h3 mb-3 font-weight-normal">Logeate, Broggi!</h1>
      <input required class="form-control col-12" name="codi" type="text" placeholder="Nom" />

      <input required class="form-control" name="password" type="text" placeholder="Codi" />

      <div class="checkbox my-2">
        <label>
          <input type="checkbox" value="remember-me" disabled> Recuerdame en un futuro
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Iniciar Sesión</button>
    </form>
    <a href="{{route('registro')}}"><button class="btn btn-outline-dark my-2 my-sm-0">Registrarse</button></a>


    <p class="mt-5 mb-3 text-muted">&copy; 2020-Covid</p>

  </div>
</section>
@endsection