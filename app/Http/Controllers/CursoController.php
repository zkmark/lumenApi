<?php 
namespace App\Http\Controllers;
//Importamos el modelo
use App\Curso;

class CursoController extends Controller{
	public function index(){
		//Traemos los cursos
		$cursos = Curso::all();
		//Regresamos un json desde Controller
		return $this->crearRespuesta($cursos, 200);
	}

	public function show($id){
		//Obtenemos el curso por id
		$curso = Curso::find($id);
		//Si existe lo regresamos
		if ($curso) {
			return $this->crearRespuesta($curso, 200);
		}
		//Si no se encuentra
		return $this->crearRespuestaError('Curso no encontrado', 404);
	}
}