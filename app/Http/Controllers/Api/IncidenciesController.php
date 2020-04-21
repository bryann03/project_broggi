<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncidenciesResource;
use App\Models\Incidencies;
use Illuminate\Http\Request;

class IncidenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencies = Incidencies::with('municipis')->with('tipus_alertant')->with('tipus_incident')->with('estats_incidencia')->with('alertants')->get();
        return IncidenciesResource::collection($incidencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $incidencies = new Incidencies();

        $incidencies->adreca = $request->input('adreca');
        $incidencies->num_incidencia = $request->input('num_incidencia');
        $incidencies->telefon_alertant = $request->input('telefon_alertant');
        $incidencies->data = $request->input('data');
        $incidencies->hora = $request->input('hora');
        $incidencies->complement_adreca = $request->input('complement_adreca');
        $incidencies->descripcio = $request->input('descripcio');
        $incidencies->municipis_id = $request->input('municipis_id');
        $incidencies->tipus_incident_id = $request->input('tipus_incident_id');
        $incidencies->estats_incidencia_id = $request->input('estats_incidencia_id');
        $incidencies->tipus_alertant_id = $request->input('tipus_alertant_id');
        $incidencies->alertants_id = $request->input('alertants_id');

        try {
            $incidencies->save();
            $respuesta = (new IncidenciesResource($incidencies))
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $e) {
            $mensaje = Utilitat::errorMessage($e);
            $respuesta = response()
                ->json(['error' => $mensaje], 400);
        }
        return $respuesta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencies $incidencies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $idIncidencies)
    {
        $incident = Incidencies::find($idIncidencies);
        $incident->num_incidencia = $request->input("num_incidencia");
        $incident->telefon_alertant = $request->input("telefon_alertant");
        $incident->data = $request->input("data");
        $incident->hora = $request->input("hora");
        $incident->adreca = $request->input("adreca");
        $incident->complement_adreca = $request->input("complement_adreca");
        $incident->descripcio = $request->input("descripcio");
        $incident->municipis_id = $request->input("municipis_id");
        $incident->tipus_incident_id = $request->input("tipus_incident_id");
        $incident->estats_incidencia_id = $request->input("estats_incidencia_id");
        $incident->tipus_alertant_id = $request->input("tipus_alertant_id");
        $incident->alertants_id = $request->input("alertants_id");

        try {
            $incident->save();
            $respuesta = (new IncidenciesResource($incident))
                ->response()
                ->setStatusCode(200);
        } catch (QueryException $e) {
            $mensaje = Utilitat::errorMessage($e);

            $respuesta = response()
                ->json(['error' => $mensaje], 400);
        }

        return $respuesta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencies $incidencies)
    {
        //
    }
}
