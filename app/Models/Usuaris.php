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
        return $this->hasOne('App\Models\Rols', 'rols_id');
    }
}
