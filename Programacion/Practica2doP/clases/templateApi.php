<?php
require_once 'clases.php';
require_once 'IApiUsable.php';
class clasesApi extends Clase implements IApiUsable
{
	/*/Cargo el log
	if ($request->getAttribute('empleado')) {
		$new_log = new Log();
		$new_log->idEmpleado = $request->getAttribute('empleado')->id;
		$new_log->accion = "Ver clases";
		$new_log->GuardarLog();
	}
	/*/
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$claseObj=Clase::TraerClase($id);
		$newResponse = $response->withJson($claseObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$clases=Clase::TraerClases();
		$newResponse = $response->withJson($clases, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$miclase = new Clase();
		$miclase->param1 = $ArrayDeParametros['param1'];
		$miclase->param2 = $ArrayDeParametros['param2'];
		$miclase->param3 = $ArrayDeParametros['param3'];
		$miclase->GuardarClase();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="Clase creada!";
		return $response->withJson($objDelaRespuesta, 200);
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$clase= new Clase();
		$clase->id=$id;
		$cantidadDeBorrados=$clase->BorrarClase();

		$objDelaRespuesta= new stdclass();
		if($cantidadDeBorrados>0) {
			$objDelaRespuesta->respuesta="Clase eliminada";
			return $response->withJson($objDelaRespuesta, 200);
		} else {
			$objDelaRespuesta->respuesta="Error eliminando la clase";
			return $response->withJson($objDelaRespuesta, 400);
		}
	}
		
	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$miclase = new Clase();
		$miclase->id=$args['id'];
		$miclase->param1=$ArrayDeParametros['param1'];
		$miclase->param2=$ArrayDeParametros['param2'];
		$miclase->param3=$ArrayDeParametros['param3'];
		$miclase->GuardarClase();
		return $response->withJson($miclase, 200);		
	}
}