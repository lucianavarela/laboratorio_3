<?php
require_once 'mozo.php';
require_once 'IApiUsable.php';
class mozoApi extends Mozo implements IApiUsable
{
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$mozoObj=Mozo::TraerMozo($id);
		$newResponse = $response->withJson($mozoObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$mozos=Mozo::TraerMozos();
		$newResponse = $response->withJson($mozos, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$param1= $ArrayDeParametros['param1'];
		$param2= $ArrayDeParametros['param2'];
		$param3= $ArrayDeParametros['param3'];
		$mimozo = new Mozo();
		$mimozo->param1=$param1;
		$mimozo->param2=$param2;
		$mimozo->param3=$param3;
		$mimozo->InsertarMozo();
		$response->getBody()->write("se guardo el mozo");
		return $response;
	}

	public function BorrarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$id=$ArrayDeParametros['id'];
		$mozo= new Mozo();
		$mozo->id=$id;
		$cantidadDeBorrados=$mozo->BorrarMozo();
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
		$mimozo = new Mozo();
		$mimozo->id=$ArrayDeParametros['id'];
		$mimozo->param1=$ArrayDeParametros['param1'];
		$mimozo->param2=$ArrayDeParametros['param2'];
		$mimozo->param3=$ArrayDeParametros['param3'];
		$resultado =$mimozo->ModificarMozo();
		$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}