@extends('templates.main')

@section('titulo', $title)

@section('principal')
    <b-link href="{{ url("/alertants") }}" class="btn btn-dark mt-5"><- VOLVER</b-link>
    <addalertant></addalertant>
@endsection