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
        //
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
    public function update(Request $request, Incidencies $incidencies)
    {
        //
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
