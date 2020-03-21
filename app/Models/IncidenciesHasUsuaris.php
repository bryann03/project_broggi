<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenciesHasUsuaris extends Model
{
    protected $table = 'incidencies_has_usuaris';
    protected $primaryKey = ['incidencies_id', 'usuaris_id'];
    public $incrementing = false;

    public $timestamps = false;

    public function usuaris()
    {
        return $this->belongsTo('App\Models\Usuaris', 'usuaris_id');
    }

    public function incidencies()
    {
        return $this->belongsTo('App\Models\Incidencies', 'incidencies_id');
    }

    //Codigo necesario para double primary key
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query->where('incidencies_id', '=', $this->getAttribute('incidencies_id'))
            ->where('usuaris_id', '=', $this->getAttribute('usuaris_id'));

        return $query;
    }
}
