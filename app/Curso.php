<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
	//Atributos que se llenaran y sean visibles
	protected $fillable = ['titulo', 'description', 'valor'];

	//Atributos ocultos
	protected $hidden = ['id', 'created_at', 'updated_at'];

	//Relaciones
	public function profesor(){
		//Un Curso es dictado por un profesor
		return $this->belongsTo('App\Profesor');
	}

	public function estudiantes(){
		//Un estudiante pertenece a muchos cursos
		//Un curso pertenece a muchos estudiantes
		return $this->belongsToMany('App\Estudiante');
	}

	/*
		Para migrar este modelo
		php artisan make:migration CursoMigration --create=cursos
		
		En singular por muchos a muchos
		php artisan make:migration CursoEstudianteMigration --create=curso_estudiante
	*/
}