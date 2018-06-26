<?php
require_once 'mesas.php';
require_once 'IApiUsable.php';

class mesasApi extends mesas implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$elmesas=mesas::TraerId($id);
     	$newResponse = $response->withJson($elmesas, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosmesass=mesas::traerTodos();
     	$newResponse = $response->withJson($todosLosmesass, 200);  
    	return $newResponse;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $numero= $ArrayDeParametros['numero'];
        $estado= "con cliente esperando pedido";
               
        $mimesa = new mesas();
        $mimesa->numero= $numero;
        $mimesa->setcodigo($numero);
        $mimesa->setestado($estado);
       
         $mimesa->Guardar();

      /*  $archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);
        $extension=array_reverse($extension);

        $archivos['foto']->moveTo($destino.$codigo.".".$extension[0]);*/
        $response->getBody()->write("se guardo la mesas ".$mimesa->getcodigo());

        return $response;
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	
     	$cantidadDeBorrados=mesas::BorrarId($id);

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="Se Borro el id: $id!!!";
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
	    $mimesa = new mesas();
	    $mimesa->id=$ArrayDeParametros['id'];
	    //$mimesa->codigo=$ArrayDeParametros['codigo'];
	    $mimesa->estado=$ArrayDeParametros['estado'];
	    
	   	$resultado =$mimesa->Modificarestado();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}