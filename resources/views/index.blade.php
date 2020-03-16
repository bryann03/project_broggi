@extends('templates.main')

@section('titulo')
    Incidencias
@endsection

@section('principal')
    <h3>Landing page - Formulario inciar sesión</h3>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ url('/registro') }}'">REGISTRO</button>
@endsection
