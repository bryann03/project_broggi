<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenciesHasRecursos extends Model
{
    protected $table = 'incidencies_has_recursos';
    protected $primaryKey = ['incidencies_id', 'recursos_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function incidencies()
    {
        return $this->belongsTo('App\Models\Incidencies', 'incidencies_id');
    }

    public function recursos()
    {
        return $this->belongsTo('App\Models\Recursos', 'recursos_id');
    }

    //Codigo necesario para double primary key
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query->where('incidencies_id', '=', $this->getAttribute('incidencies_id'))
            ->where('recursos_id', '=', $this->getAttribute('recursos_id'));

        return $query;
    }
}
