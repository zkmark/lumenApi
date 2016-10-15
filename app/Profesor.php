<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model{
	//Crear tabla profesores
	protected $table = 'profesores';

	//Atributos que se llenaran y sean visibles
	protected $fillable = ['nombre', 'direccion', 'telefono', 'profesion'];

	//Atributos ocultos
	protected $hidden = ['id', 'created_at', 'updated_at'];

	//Relaciones

	public function cursos(){
		//Un profesor tiene muchos cursos
		return $this->hasMany('App\Curso');
	}

	/*
		Para migrar este modelo
		php artisan make:migration ProfesorMigration --create=profesores
	*/
}