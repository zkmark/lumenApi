<?php 
namespace App\Http\Controllers;

use App\Profesor;
//Para inyeccion de dependencias
use Illuminate\Http\Request;

class ProfesorController extends Controller{
	
	public function index(){
		$profesores = Profesor::all();
		return $this->crearRespuesta($profesores, 200);
	}
	
	public function show($id){
		$profesor = Profesor::find($id);
		if($profesor){
			return $this->crearRespuesta($profesor, 200);
		}
		return $this->crearRespuestaError('Profesor no encontrado', 404);
	}

	public function store(Request $request){
		//Validamos los daos que recibiremos
		$reglas = 
		[
			'nombre' => 'required',
			'direccion' => 'required',
			'telefono' => 'required|numeric',
			'profesion' => 'required|in:ingeniería,matemática,física',
		];
		$this->validate($request, $reglas);

		//Obtenemos todos los datos de la peticion y creamos
		Profesor::create($request->all());
		return $this->crearRespuesta('El profesor ha sido creado', 201);
	}

	public function update()
	{
		return 'desde update en profesorcontroller';
	}
	public function destroy()
	{
		return 'desde destroy en profesorcontroller';
	}
}