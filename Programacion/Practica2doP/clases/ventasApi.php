<?php
require_once 'ventas.php';
require_once 'IApiUsable.php';
class ventasApi extends Venta implements IApiUsable
{
	/*/Cargo el log
	if ($request->getAttribute('empleado')) {
		$new_log = new Log();
		$new_log->idEmpleado = $request->getAttribute('empleado')->id;
		$new_log->accion = "Ver ventas";
		$new_log->GuardarLog();
	}
	/*/
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$ventaObj=Venta::TraerVenta($id);
		$newResponse = $response->withJson($ventaObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$ventas=Venta::TraerVentas();
		$newResponse = $response->withJson($ventas, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$venta = new Venta();
		$venta->usuario = $ArrayDeParametros['usuario'];
		$venta->bici = $ArrayDeParametros['bici'];
		$venta->GuardarVenta();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="Venta creada!";
		return $response->withJson($objDelaRespuesta, 200);
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$venta= new Venta();
		$venta->id=$id;
		$cantidadDeBorrados=$venta->BorrarVenta();

		$objDelaRespuesta= new stdclass();
		if($cantidadDeBorrados>0) {
			$objDelaRespuesta->respuesta="Venta eliminada";
			return $response->withJson($objDelaRespuesta, 200);
		} else {
			$objDelaRespuesta->respuesta="Error eliminando la venta";
			return $response->withJson($objDelaRespuesta, 400);
		}
	}
		
	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$venta = Venta::TraerVenta($args['id']);
		if ($venta) {
			$venta->usuario=$ArrayDeParametros['usuario'];
			$venta->bici=$ArrayDeParametros['bici'];
			$venta->GuardarVenta();
			return $response->withJson($venta, 200);	
		} else {
			$objDelaRespuesta= new stdclass();
			$objDelaRespuesta->respuesta="No se encontro su venta";
			return $response->withJson($objDelaRespuesta, 200);
		}
	}
}