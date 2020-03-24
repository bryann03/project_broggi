@extends('templates.main')

@section('titulo')
    Incidencias
@endsection

@section('principal')
    <login></login>
    <button type="button" class="btn btn-primary" onclick="window.location='{{ url('/registro') }}'">REGISTRO</button>
@endsection
