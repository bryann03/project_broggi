<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuaris extends Model
{
    protected $table = 'usuaris';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function rols()
    {
        return $this->belongsTo('App\Models\Rols', 'rols_id');
    }

    public function incidencies()
    {
        return $this->belongsToMany('App\Models\Incidencies', 'incidencies_has_usuaris', 'usuaris_id', 'incidencies_id');
    }

    public function recursos()
    {
        return $this->hasMany('App\Models\Recursos', 'id_usuario');
    }
}
