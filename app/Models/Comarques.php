<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comarques extends Model
{
    protected $table = 'comarques';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function municipis()
    {
        return $this->hasMany('App\Models\Municipis', 'comarques_id');
    }

    public function provincies()
    {
        return $this->belongsTo('App\Models\Provincies', 'provincies_id');
    }
}
