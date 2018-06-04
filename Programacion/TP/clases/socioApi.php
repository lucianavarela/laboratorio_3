<?php
require_once 'socio.php';
require_once 'IApiUsable.php';
class socioApi extends socio implements IApiUsable
{
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$socioObj=socio::TraerSocio($id);
		$newResponse = $response->withJson($socioObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$socios=socio::TraerSocios();
		$newResponse = $response->withJson($socios, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$param1= $ArrayDeParametros['param1'];
		$param2= $ArrayDeParametros['param2'];
		$param3= $ArrayDeParametros['param3'];
		$misocio = new socio();
		$misocio->param1=$param1;
		$misocio->param2=$param2;
		$misocio->param3=$param3;
		$misocio->InsertarSocioParametros();
		$archivos = $request->getUploadedFiles();
		$destino="./fotos/";
		$nombreAnterior=$archivos['foto']->getClientFilename();
		$extension= explode(".", $nombreAnterior)  ;
		$extension=array_reverse($extension);
		$archivos['foto']->moveTo($destino.$param1.".".$extension[0]);
		$response->getBody()->write("se guardo el socio");
		return $response;
	}

	public function BorrarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$id=$ArrayDeParametros['id'];
		$socio= new socio();
		$socio->id=$id;
		$cantidadDeBorrados=$socio->BorrarSocio();
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
		$misocio = new socio();
		$misocio->id=$ArrayDeParametros['id'];
		$misocio->param1=$ArrayDeParametros['param1'];
		$misocio->param2=$ArrayDeParametros['param2'];
		$misocio->param3=$ArrayDeParametros['param3'];
		$resultado =$misocio->ModificarSocioParametros();
		$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}