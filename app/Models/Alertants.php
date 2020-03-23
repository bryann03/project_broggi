<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alertants extends Model
{
    protected $table = 'alertants';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function incidencies()
    {
        return $this->hasMany('App\Comment\Incidencies', 'alertants_id');
    }

    public function municipis()
    {
        return $this->belongsTo('App\Models\Municipis', 'municipis_id');
    }

    public function tipus_alertant()
    {
        return $this->belongsTo('App\Models\TipusAlertant', 'tipus_alertant_id');
    }

}
