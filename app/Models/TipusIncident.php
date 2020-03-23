<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusIncident extends Model
{
    protected $table = 'tipus_incident';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function incidencies()
    {
        return $this->hasMany('App\Models\Incidencies', 'tipus_incident_id');
    }
}
