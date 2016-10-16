<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//Importamos los modelos
use App\Estudiante;
use App\Profesor;
use App\Curso;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call('UserTableSeeder');
        //Desactiva verificacion de llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        //Borramos lo que tienen los datos de las tablas
        Estudiante::truncate();
        Profesor::truncate();
        Curso::truncate();
        DB::table('curso_estudiante')->truncate();
        DB::table('oauth_clients')->truncate();

        //Creamos
        factory(Profesor::class, 50)->create();
        factory(Estudiante::class, 500)->create();
        //40 cursos, con profesor_id entre 1 y 50
        factory(Curso::class, 40)->create()
        //Le pasamos la instancia del curso que estamos creando
        ->each(function($curso){
            //Le agregamos los estudiantes a la relacion
            $curso->estudiantes()->attach(array_rand(range(1, 500),40));
        });

        $this->call('OAuthClientSeeder');

        Model::reguard();
    }

    /*
        Para ejecutar 
        php artisan db:seed
    */
}
