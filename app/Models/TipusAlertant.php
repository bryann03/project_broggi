<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusAlertant extends Model
{
    protected $table = 'tipus_alertant';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function incidencies()
    {
        return $this->hasMany('App\Models\Incidencies', 'tipus_alertant_id');
    }

    public function alertants()
    {
        return $this->hasMany('App\Models\Alertants', 'tipus_alertant_id');
    }

}
