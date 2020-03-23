<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Afectats extends Model
{
    protected $table = 'afectats';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function municipis()
    {
        return $this->belongsTo('App\Models\Municipis', 'municipis_id');
    }

    public function incidencies()
    {
        return $this->belongsToMany('App\Models\Incidencies', 'incidencies_has_afectats', 'afectats_id', 'incidencies_id');
    }
}
