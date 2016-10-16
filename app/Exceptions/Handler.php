<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

//
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler{
		/**
		 * A list of the exception types that should not be reported.
		 *
		 * @var array
		 */
		protected $dontReport = [
				HttpException::class,
		];

		/**
		 * Report or log an exception.
		 *
		 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
		 *
		 * @param  \Exception  $e
		 * @return void
		 */
		public function report(Exception $e){
				return parent::report($e);
		}

		/**
		 * Render an exception into an HTTP response.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Exception  $e (Para determinar tipo de exepcion que recibimos)
		 * @return \Illuminate\Http\Response
		 */
		public function render($request, Exception $e){
			//Verificamos si estamos en desarrollo o produccion

			//Accedemos a .env y su var APP_DEBUG
			if(env('APP_DEBUG')){
				//Mostramos la respuesta en html
				return parent::render($request, $e);
			}
			
			//Si estamos en produccion (Agregamos arriba)
			if($e instanceof NotFoundHttpException){
				//Regresamos una ecepcion 400 de peticion de manera incorrecta
				return response()->json(['message' => 'Petición inválida', 'code' => 400], 400);
			}
			
			//Si no mostrarmos un error inesperado
			return response()->json(['message' => 'Error inesperado, intentar más tarde', 'code' => 500], 500);  

		}
}
