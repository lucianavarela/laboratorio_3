<?php
require_once 'clase.php';
require_once 'IApiUsable.php';
class claseApi extends clase implements IApiUsable
{
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$claseObj=clase::TraerClase($id);
		$newResponse = $response->withJson($claseObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$clases=clase::TraerClases();
		$newResponse = $response->withJson($clases, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$param1= $ArrayDeParametros['param1'];
		$param2= $ArrayDeParametros['param2'];
		$param3= $ArrayDeParametros['param3'];
		$miclase = new clase();
		$miclase->param1=$param1;
		$miclase->param2=$param2;
		$miclase->param3=$param3;
		$miclase->InsertarClaseParametros();
		$archivos = $request->getUploadedFiles();
		$destino="./fotos/";
		$nombreAnterior=$archivos['foto']->getClientFilename();
		$extension= explode(".", $nombreAnterior)  ;
		$extension=array_reverse($extension);
		$archivos['foto']->moveTo($destino.$param1.".".$extension[0]);
		$response->getBody()->write("se guardo el clase");
		return $response;
	}

	public function BorrarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$id=$ArrayDeParametros['id'];
		$clase= new clase();
		$clase->id=$id;
		$cantidadDeBorrados=$clase->BorrarClase();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->cantidad=$cantidadDeBorrados;
		if($cantidadDeBorrados>0)
			{
				$objDelaRespuesta->resultado="algo borro!!!";
			}
			else
			{
				$objDelaRespuesta->resultado="no Borro nada!!!";
			}
		$newResponse = $response->withJson($objDelaRespuesta, 200);  
		return $newResponse;
	}
		
	public function ModificarUno($request, $response, $args) {
		//$response->getBody()->write("<h1>Modificar  uno</h1>");
		$ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros);    	
		$miclase = new clase();
		$miclase->id=$ArrayDeParametros['id'];
		$miclase->param1=$ArrayDeParametros['param1'];
		$miclase->param2=$ArrayDeParametros['param2'];
		$miclase->param3=$ArrayDeParametros['param3'];
		$resultado =$miclase->ModificarClaseParametros();
		$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}