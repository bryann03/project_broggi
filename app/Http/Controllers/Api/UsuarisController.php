<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarisResource;
use App\Models\Usuaris;
use Illuminate\Http\Request;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuaris = Usuaris::all();
        return UsuarisResource::collection($usuaris);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuari = new Usuaris();

        $usuari->nom = $request->input('nom');
        $usuari->codi = $request->input('codi');
        $usuari->contrasenya = $request->input('contrasenya');
        $usuari->rols_id = $request->input('rols_id');

        try
        {
            $usuari->save();
            $respuesta = (new UsuarisResource($usuari))
                ->response()
                ->setStatusCode(201);
        }
        catch (QueryException $e)
        {
            $mensaje = Utilitat::errorMessage($e);

            $respuesta = response()
                ->json(['error' => $mensaje], 400);
        }
        return $respuesta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function show(Usuaris $usuaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuaris $usuaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuaris $usuaris)
    {
        //
    }
}
