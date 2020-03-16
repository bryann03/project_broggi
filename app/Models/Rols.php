<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rols extends Model
{
    protected $table = 'rols';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public $timestamps = false;

    public function usuaris()
    {
        return $this->hasMany('App\Models\Usuaris', 'rols_id');
    }
}
