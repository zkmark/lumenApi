<?php 
namespace App\Http\Controllers;

use App\Profesor;
use App\Curso;
//
use Illuminate\Http\Request;

class ProfesorCursoController extends Controller{

	public function __construct(){
		//Para protegernos este middleware se aplicara excepto a index y show
		$this->middleware('oauth', ['except' => ['index']]);
	}

	public function index($profesor_id){
		$profesor = Profesor::find($profesor_id);
		if($profesor){

			$cursos = $profesor->cursos;
			return $this->crearRespuesta($cursos, 200);

		}
		return $this->crearRespuestaError('No se puede encontrar un profesor con el id dado', 404);
	}

	//Agregar cun curso a un profesor, (el curso no existe)
	public function store(Request $request, $profesor_id){
		//Obtenemos el profesor
		$profesor = Profesor::find($profesor_id);
		
		if($profesor){
			//Validamos
			$this->validacion($request);

			//Obtenemos los campos
			$campos = $request->all();
			//Le agergamos el profesor_id (agregar al modelo)
			$campos['profesor_id'] = $profesor_id;

			Curso::create($campos);
			return $this->crearRespuesta('El curso se ha creado satisfactoriamente', 200);
		}
		return $this->crearRespuestaError('No existe un profesor con el id dado', 404);
	}

	public function update(Request $request, $profesor_id, $curso_id){
		$profesor = Profesor::find($profesor_id);
		
		if($profesor){
			$curso = Curso::find($curso_id);
			
			//Si exite
			if($curso){
				
				//Validamos
				$this->validacion($request);
				//Obtenemos los datos
				$curso->titulo = $request->get('titulo');
				$curso->descripcion = $request->get('descripcion');
				$curso->valor = $request->get('valor');
				$curso->profesor_id = $profesor_id;
				
				$curso->save();
				
				return $this->crearRespuesta('El curso se ha actualizado', 200);
			}

			return $this->crearRespuestaError('No existe un curso con el id dado', 404);
		}

		return $this->crearRespuestaError('No existe un profesor con el id dado', 404);
	}


	public function destroy($profesor_id, $curso_id){
		
		$profesor = Profesor::find($profesor_id);
		
		if($profesor){
			//Obtenemos los cursos del profesor
			$cursos = $profesor->cursos();
			
			//Si es dueño de ese curso
			if($cursos->find($curso_id)){
				$curso = Curso::find($curso_id);
				//Desvinculamos curso de los estudiantes, (se podria usar sync)
				$curso->estudiantes()->detach();
				$curso->delete();
				return $this->crearRespuesta('Curso eliminado', 200);
			}

			return $this->crearRespuestaError('No existe un curso con este id asociado a este profesor', 404);

		}
		return $this->crearRespuestaError('No existe un profesor con el id dado', 404);
	}

	public function validacion($request)
	{
		$reglas = 
		[
			'titulo' => 'required',
			'descripcion' => 'required',
			'valor' => 'required|numeric'
		];
		$this->validate($request, $reglas);
	}
}