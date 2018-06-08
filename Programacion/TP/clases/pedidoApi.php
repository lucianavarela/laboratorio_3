<?php

class pedidoApi extends Pedido implements IApiUsable
{
	public function TraerUno($request, $response, $args) {
		$codigoPedido=$args['codigoPedido'];
		$codigoMesa=$args['codigoMesa'];
		$pedido=Pedido::TraerPedido($codigoPedido, $codigoMesa);
		$newResponse = $response->withJson($pedido, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$pedidos=Pedido::TraerPedidos();
		$newResponse = $response->withJson($pedidos, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$archivos = $request->getUploadedFiles();
		//Cargo el pedido
		$mipedido = new Pedido();
		$mipedido->SetNombreCliente($ArrayDeParametros['nombreCliente']);
		$mipedido->SetEstado('nuevo');
		$mipedido->SetIdMesa($ArrayDeParametros['idMesa']);
		if (sizeof($archivos)) {
			$destino="./fotos/";
			$nombreAnterior=$archivos['foto']->getClientFilename();
			$extension= explode(".", $nombreAnterior)  ;
			$extension=array_reverse($extension);
			$mipedido->SetFoto($extension[0]);
		} else {
			$mipedido->SetFoto(NULL);
		}
		$codigo = $mipedido->InsertarPedido();
		if ($codigo) {
			//Me encargo de la foto
			if (sizeof($archivos)) {
				$archivos['foto']->moveTo($destino.$codigo.".".$extension[0]);		
			}
			$response->getBody()->write("Su pedido a sido ingresado! Codigo de seguimiento: $codigo");
			return $response;
		} else {
			$response->getBody()->write("Esta mesa no está cargada en el sistema o está ocupada.");
			return $response;
		}
	}

	public function BorrarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$id=$ArrayDeParametros['id'];
		$pedido= new Pedido();
		$pedido->id=$id;
		$cantidadDeBorrados=$pedido->BorrarPedido();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->cantidad=$cantidadDeBorrados;
		if($cantidadDeBorrados>0)
			{
				$objDelaRespuesta->resultado="Pedido eliminado";
			}
			else
			{
				$objDelaRespuesta->resultado="Pedido inexistente";
			}
		$newResponse = $response->withJson($objDelaRespuesta, 200);  
		return $newResponse;
	}
		
	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$mipedido = new Pedido();
		$mipedido->id=$ArrayDeParametros['id'];
		$mipedido->nombreCliente=$ArrayDeParametros['nombreCliente'];
		$mipedido->codigo=$ArrayDeParametros['codigo'];
		$mipedido->estado=$ArrayDeParametros['estado'];
		$mipedido->importe=$ArrayDeParametros['importe'];
		$mipedido->idMesa=$ArrayDeParametros['idMesa'];
		$mipedido->foto=$ArrayDeParametros['foto'];
		$mipedido->fechaIngresado=$ArrayDeParametros['fechaIngresado'];
		$mipedido->fechaEstimado=$ArrayDeParametros['fechaEstimado'];
		$mipedido->fechaEntregado=$ArrayDeParametros['fechaEntregado'];
		$resultado =$mipedido->ModificarPedido();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}