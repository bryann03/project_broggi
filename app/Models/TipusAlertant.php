<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusAlertant extends Model
{
    protected $table = 'tipus_alertant';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

}
