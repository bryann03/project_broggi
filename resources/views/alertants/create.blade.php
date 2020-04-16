@extends('../template/main')
@section('title', 'GESTIÓ ALERTANT')


@section('body')

    <div class="row mt-5">

        <h1 class="display-4" for="exampleFormControlInput1">{{ $alertant->nom }}</h1>

    </div>

    <div class="row mt-5">

        <div class="col-4">

            <img class="img-fluid" style="height: 200px; width: 200px"><br>

            <button type="button" class="btn btn-dark mt-2 align-bottom">ACTUALIZAR</button><br>
            <button type="button" class="btn btn-danger mt-2 align-bottom">ELIMINAR</button>

        </div>

        <div class="col-8">

            <form action="{{ action("AlertantController@create") }}" method="get" class="form-horizontal">

                <div class="form-group">
                    <label for="exampleFormControlInput1">Nom:</label>
                    <input class="form-control" id="exampleFormControlInput1" placeholder="Nom" value="{{ $alertant->nom }}">
                </div>


                <div class="form-group">
                    <label for="exampleFormControlInput1">Adreça:</label>
                    <input class="form-control" id="exampleFormControlInput1" placeholder="Adreça" value="{{ $alertant->adreca }}">
                </div>

                
                <div class="form-group">
                    <label for="exampleFormControlInput1">Municipi:</label>
                    <input class="form-control" id="exampleFormControlInput1" placeholder="Municipi" value="{{ $alertant->municipis_id }}">
                </div>


                <div class="form-group">
                    <label for="exampleFormControlInput1">Telefon:</label>
                    <input class="form-control" id="exampleFormControlInput1" placeholder="Telefon" value="{{ $alertant->telefon }}">
                </div>


                <div class="form-group">
                    <label for="exampleFormControlInput1">Tipus Alertant:</label>
                    <input class="form-control" id="exampleFormControlInput1" placeholder="Tipus Alertant" value="{{ $alertant->tipus_alertant_id }}">
                </div>
            </form>

        </div>

    </div>

@endsection