<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model{
	//Atributos que se llenaran y sean visibles
	protected $fillable = ['nombre', 'direccion', 'telefono', 'carrera'];

	//Atributos ocultos
	protected $hidden = ['id', 'created_at', 'updated_at'];

	//Relaciones
	public function curso(){
		//Un estudiante pertenece a muchos cursos
		//Un curso pertenece a muchos estudiantes
		return $this->belongsToMany('App\Curso');
	}

	/*
		Para migrar este modelo
		php artisan make:migration EstudianteMigration --create=estudiantes
	*/
}