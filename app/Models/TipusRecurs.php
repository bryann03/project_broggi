<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusRecurs extends Model
{
    protected $table = 'tipus_recurs';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function recursos()
    {
        return $this->hasMany('App\Models\Recursos', 'tipus_recurs_id');
    }
}
