<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroIncidencias extends Controller
{
    public function index()
        {
            return \view('registroIncidencia');
        }
}
