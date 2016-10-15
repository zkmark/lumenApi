<?php

namespace App\Http\Controllers;
//Para inyeccion de dependencias
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function crearRespuesta($datos, $codigo){
		//Regresa un json 
		return response()->json(['data' => $datos], $codigo);
	}

	public function crearRespuestaError($mensaje, $codigo){
		//'code'=> $codigo se le muestra al cliente y $codigo se envia a la respuesta
		return response()->json(['message' => $mensaje, 'code'=> $codigo], $codigo);
	}

	protected function buildFailedValidationResponse(Request $request, array $errors){
  	//Para regresar un json en lugar de una redireccion
    return $this->crearRespuestaError($errors, 422);
  }
}
