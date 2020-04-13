<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipusRecursResource;
use App\Models\TipusRecurs;
use Illuminate\Http\Request;

class TipusRecursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipusRecurs = TipusRecurs::all();
        return TipusRecursResource::collection($tipusRecurs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipusRecurs = new TipusRecurs();

        $tipusRecurs->tipus = $request->input('tipus');
        $tipusRecurs->esSanitari = $request->input('esSanitari');
        $tipusRecurs->esPolicial = $request->input('esPolicial');

        try
        {
            $tipusRecurs->save();
            $respuesta = (new TipusRecursResource($tipusRecurs))
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
     * @param  \App\Models\TipusRecurs  $tipusRecurs
     * @return \Illuminate\Http\Response
     */
    public function show(TipusRecurs $tipusRecurs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipusRecurs  $tipusRecurs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipusRecurs $tipusRecurs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipusRecurs  $tipusRecurs
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipusRecurs $tipusRecurs)
    {
        //
    }
}
