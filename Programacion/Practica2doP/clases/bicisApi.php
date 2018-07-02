<?php
require_once 'bicis.php';
require_once 'IApiUsable.php';
class bicisApi extends Bici implements IApiUsable
{
	/*/Cargo el log
	if ($request->getAttribute('empleado')) {
		$new_log = new Log();
		$new_log->idEmpleado = $request->getAttribute('empleado')->id;
		$new_log->accion = "Ver bicis";
		$new_log->GuardarLog();
	}
	/*/
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$biciObj=Bici::TraerBici($id);
		$newResponse = $response->withJson($biciObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$bicis=Bici::TraerBicis();
		$newResponse = $response->withJson($bicis, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$bici = new Bici();
		$archivos = $request->getUploadedFiles();
		$destino="./fotos/";
		$nombreAnterior=$archivos['foto']->getClientFilename();
		$extension= explode(".", $nombreAnterior)  ;
		$extension=array_reverse($extension);
		$bici->GuardarBici();
		$archivos['foto']->moveTo($destino.$ArrayDeParametros['marca'].".".$extension[0]);
		$bici->marca = $ArrayDeParametros['marca'];
		$bici->precio = $ArrayDeParametros['precio'];
		$bici->foto = $ArrayDeParametros['marca'].".".$extension[0];
		$bici->GuardarBici();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="Bici creada!";
		return $response->withJson($objDelaRespuesta, 200);
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$bici= new Bici();
		$bici->id=$id;
		$cantidadDeBorrados=$bici->BorrarBici();

		$objDelaRespuesta= new stdclass();
		if($cantidadDeBorrados>0) {
			$objDelaRespuesta->respuesta="Bici eliminada";
			return $response->withJson($objDelaRespuesta, 200);
		} else {
			$objDelaRespuesta->respuesta="Error eliminando la bici";
			return $response->withJson($objDelaRespuesta, 400);
		}
	}
		
	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$bici = new Bici();
		$bici->id=$args['id'];
		$bici->marca=$ArrayDeParametros['marca'];
		$bici->precio=$ArrayDeParametros['precio'];
		$bici->foto=$ArrayDeParametros['foto'];
		$bici->GuardarBici();
		return $response->withJson($bici, 200);		
	}
}