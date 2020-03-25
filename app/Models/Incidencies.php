<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencies extends Model
{
    protected $table = 'incidencies';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function usuaris()
    {
        return $this->belongsToMany('App\Models\Usuaris', 'incidencies_has_usuaris', 'incidencies_id', 'usuaris_id');
    }

    public function afectats()
    {
        return $this->belongsToMany('App\Models\Afectats', 'incidencies_has_afectats', 'incidencies_id', 'afectats_id');
    }

    public function recursos()
    {
        return $this->belongsToMany('App\Models\Recursos', 'incidencies_has_recursos', 'incidencies_id', 'recursos_id')
                    ->withPivot('prioritat', 'hora_activacio', 'hora_mobilitzacio', 'hora_asistencia', 'hora_transport',
                                'hora_arribada_hospital', 'hora_transferencia', 'hora_finalitzacio');
    }

    public function tipus_incident()
    {
        return $this->belongsTo('App\Models\TipusIncident', 'tipus_incident_id');
    }

    public function estats_incidencia()
    {
        return $this->belongsTo('App\Models\EstatsIncidencia', 'estats_incidencia_id');
    }

    public function alertants()
    {
        return $this->belongsTo('App\Models\Alertants', 'alertants_id');
    }

    public function tipus_alertant()
    {
        return $this->belongsTo('App\Models\TipusAlertant', 'tipus_alertant_id');
    }

    public function municipis()
    {
        return $this->belongsTo('App\Models\Municipis', 'municipis_id');
    }
}
