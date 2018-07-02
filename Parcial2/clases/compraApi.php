<?php
require_once 'compra.php';
require_once 'IApiUsable.php';
class compraApi extends Compra implements IApiUsable
{
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$compraObj=Compra::TraerCompra($id);
		$newResponse = $response->withJson($compraObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$compras=Compra::TraerCompras();
		$newResponse = $response->withJson($compras, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		if ($ArrayDeParametros['articulo'] && $ArrayDeParametros['precio'] && $ArrayDeParametros['usuario']) {
			$micompra = new Compra();
			$micompra->articulo = $ArrayDeParametros['articulo'];
			$micompra->fecha = date("Y-m-d H:i:s");
			$micompra->precio = $ArrayDeParametros['precio'];
			$micompra->usuario = $ArrayDeParametros['usuario'];
			$id = $micompra->InsertarCompra();

			$archivos = $request->getUploadedFiles();
			$destino="./IMGCompras/";
			$nombreAnterior=$archivos['foto']->getClientFilename();
			$extension= explode(".", $nombreAnterior)  ;
			$extension=array_reverse($extension);
			$archivos['foto']->moveTo($destino.$id."-".$ArrayDeParametros['articulo'].".".$extension[0]);
			
			$objDelaRespuesta= new stdclass();
			$objDelaRespuesta->respuesta="Compra creada!";
			return $response->withJson($objDelaRespuesta, 200);
		} else {
			$objDelaRespuesta= new stdclass();
			$objDelaRespuesta->respuesta="Parametros faltantes";
			return $response->withJson($objDelaRespuesta, 401);
		}
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$compra= new Compra();
		$compra->id=$id;
		$cantidadDeBorrados=$compra->BorrarCompra();

		$objDelaRespuesta= new stdclass();
		if($cantidadDeBorrados>0) {
			$objDelaRespuesta->respuesta="Compra eliminada";
			return $response->withJson($objDelaRespuesta, 200);
		} else {
			$objDelaRespuesta->respuesta="Error eliminando la compra";
			return $response->withJson($objDelaRespuesta, 400);
		}
	}
		
	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$micompra = new Compra();
		$micompra->id=$args['id'];
		$micompra->articulo=$ArrayDeParametros['articulo'];
		$micompra->fecha=$ArrayDeParametros['fecha'];
		$micompra->precio=$ArrayDeParametros['precio'];
		$micompra->usuario=$ArrayDeParametros['usuario'];
		$micompra->GuardarCompra();
		return $response->withJson($micompra, 200);		
	}
}