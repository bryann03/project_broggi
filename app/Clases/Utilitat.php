<?php
namespace App\Clases;

class Utilitat
{
    public static function errorMessage($e)
    {
        if(!empty($e->errorInfo[1]))
        {
            switch($e->errorInfo[1])
            {
                case 1062:
                    $mensaje = '¡El registro introducido está duplicado!';
                    break;
                case 1451:
                    $mensaje = '¡Registro con elementos relacionados!';
                    break;
                default:
                    $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                    break;
            }
        }
        else
        {
            switch($e->getCode())
            {
                case 1044:
                    $mensaje = 'Usuario incorrecto';
                    break;
                case 1049:
                    $mensaje = 'No se encuentra la BD';
                    break;
                case 2002:
                    $mensaje = 'No se encuentra el servidor';
                    break;
                default:
                    $mensaje = $e->getCode() . ' - ' . $e->getMessage();
                    break;
            }
        }
        return $mensaje;
    }
}
