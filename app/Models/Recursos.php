<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    protected $table = 'recursos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function incidencies()
    {
        return $this->belongsToMany('App\Models\Incidencies', 'incidencies_has_recursos', 'recursos_id', 'incidencies_id');
    }

    public function tipus_recurs()
    {
        return $this->belongsTo('App\Models\TipusRecurs', 'tipus_recurs_id');
    }
}
