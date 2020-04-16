<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlertantsResource;
use App\Models\Alertants;
use Illuminate\Http\Request;

use App\Utils\Utilidad;
use Illuminate\Database\QueryException;

class AlertantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertants = Alertants::all();
        return AlertantsResource::collection($alertants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function show(Alertants $alertants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertants $alertants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_alertant)
    {
        $alertant = Alertants::find($id_alertant);

        if($alertant != null){
            try {
                $alertant->delete();
                $respuesta = (new AlertantsResource($alertant))
                ->response()
                ->setStatusCode(200);
    
            } catch (QueryException $e) {
                $mensaje = Utilidad::errorMessage($e);
                $respuesta = response()->json(["error"=>$mensaje], 400);
            }
        }else{
            $respuesta = response()->json(["error"=> "Registro no encontrado"], 404);
        }

        return $respuesta;
    }
}
