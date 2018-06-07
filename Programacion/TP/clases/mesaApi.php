<?php
require_once 'mesa.php';
require_once 'IApiUsable.php';
class mesaApi extends Mesa implements IApiUsable
{
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$mesaObj=Mesa::TraerMesa($id);
		$newResponse = $response->withJson($mesaObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$mesas=Mesa::TraerMesas();
		$newResponse = $response->withJson($mesas, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$param1= $ArrayDeParametros['param1'];
		$param2= $ArrayDeParametros['param2'];
		$param3= $ArrayDeParametros['param3'];
		$mimesa = new Mesa();
		$mimesa->param1=$param1;
		$mimesa->param2=$param2;
		$mimesa->param3=$param3;
		$mimesa->InsertarMesa();
		$archivos = $request->getUploadedFiles();
		$destino="./fotos/";
		$nombreAnterior=$archivos['foto']->getClientFilename();
		$extension= explode(".", $nombreAnterior)  ;
		$extension=array_reverse($extension);
		$archivos['foto']->moveTo($destino.$param1.".".$extension[0]);
		$response->getBody()->write("se guardo el mesa");
		return $response;
	}

	public function BorrarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$id=$ArrayDeParametros['id'];
		$mesa= new Mesa();
		$mesa->id=$id;
		$cantidadDeBorrados=$mesa->BorrarMesa();
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
		$mimesa = new Mesa();
		$mimesa->id=$ArrayDeParametros['id'];
		$mimesa->param1=$ArrayDeParametros['param1'];
		$mimesa->param2=$ArrayDeParametros['param2'];
		$mimesa->param3=$ArrayDeParametros['param3'];
		$resultado =$mimesa->ModificarMesa();
		$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}