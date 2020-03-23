<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincies extends Model
{
    protected $table = 'provincies';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function comarques()
    {
        return $this->hasMany('App\Models\Comarques', 'provincies_id');
    }
}
