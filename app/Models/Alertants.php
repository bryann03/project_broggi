<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alertants extends Model
{
    protected $table = 'alertants';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

}
