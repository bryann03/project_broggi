<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipis extends Model
{
    protected $table = 'municipis';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function incidencies()
    {
        return $this->hasMany('App\Models\Incidencies', 'municipis_id');
    }

    public function alertants()
    {
        return $this->hasMany('App\Models\Alertants', 'municipis_id');
    }

    public function afectats()
    {
        return $this->hasMany('App\Models\Afectats', 'municipis_id');
    }

    public function comarques()
    {
        return $this->belongsTo('App\Models\Comarques', 'comarques_id');
    }
}
