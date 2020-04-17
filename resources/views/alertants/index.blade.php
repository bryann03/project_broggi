@extends('templates.main')

@section('titulo', $title)

@section('principal')

    <div class="card mt-5">
        <div class="card-body">
            <a href={{ action("AlertantController@create") }} class="btn btn-dark">AFEGIR ALERTANT</a>
        </div>
    </div>

    <div style="margin-top: 100px">
        <alertants></alertants>
    </div>
@endsection