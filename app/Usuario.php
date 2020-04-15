<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use Notifiable;

    protected $table = usuaris;
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'rols_id');
    }
}
