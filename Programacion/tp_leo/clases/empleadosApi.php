<?php
require_once 'empleados.php';
require_once 'IApiUsable.php';
require_once 'login.php';


class empleadosApi extends empleados implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
					
		 $id=$args['id'];        
        $elEmpleado=empleados::TraerId($id);
        //var_dump($elEmpleado);
     	$newResponse = $response->withJson($elEmpleado, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosEmpleados=empleados::traerTodos();
     	$newResponse = $response->withJson($todosLosEmpleados, 200);  
    	return $newResponse;
    }
      public function CargarUno($request, $response, $args) {
		 $ArrayDeParametros = $request->getParsedBody();
		
		  
        //var_dump($ArrayDeParametros);
				
		$nombre= $ArrayDeParametros['nombre'];
        $turno= $ArrayDeParametros['turno'];
		$tipo= $ArrayDeParametros['tipo'];
		$pass= $ArrayDeParametros['pass'];
		
		$miEmpleado = new empleados();
		$miEmpleado->setnombre($nombre);
		$miEmpleado->setturno($turno);
		$miEmpleado->settipo($tipo);
		$miEmpleado->setpass($pass);
		$miEmpleado->Guardar();


        /*$miEmpleado = new empleados($nombre,$turno,$tipo,$pass);
      	$miEmpleado->Guardar();*/

        /*$archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);
        $extension=array_reverse($extension);

		$archivos['foto']->moveTo($destino.$nombre.".".$extension[0]);*/
		

        //$response->getBody()->write("se guardo el empleado");

        return $response;
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
		 $id=$ArrayDeParametros['id'];   
		 	     	
     	$cantidadDeBorrados=empleados::BorrarId($id);

     	$objDelaRespuesta= new stdclass();
	   // $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados)
	    	{
				 $objDelaRespuesta->resultado="algo borro!!!";
				 
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada !!!";
	    	}
		$newResponse = $response->withJson($objDelaRespuesta, 200);  
		
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
     	$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
	    $miEmpleado = new empleados();
	    $id=$ArrayDeParametros['id'];
		$miEmpleado->nombre=$ArrayDeParametros['nombre'];
	    $miEmpleado->turno=$ArrayDeParametros['turno'];
		$miEmpleado->tipo=$ArrayDeParametros['tipo'];
		

	   	$resultado =$miEmpleado->Modificar($id);
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
	
	/////
	// --------------LOGIn

	public function verificar($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
	  //var_dump($ArrayDeParametros);
	  $nombre= $ArrayDeParametros['nombre'];
	  $pass= $ArrayDeParametros['pass'];
	  $miLogin = empleados::verificarlogin($nombre,$pass);
	  
	  $response->getBody()->write($miLogin);


        return $response;
	}


	public function traerLogs($request, $response, $args) {
		$todosLosEmpleados=empleados::traerLogs();
		$data="";
		/*foreach($todosLosEmpleados as $aux){
			$data .= $aux->getnombre()." - ".$aux->getid()." - ".$aux->gettipo()." - ".$aux->fecha." - ".$aux->hora."<br>";
		}*/
	   $newResponse = $response->withJson($todosLosEmpleados, 200);  
	  return $newResponse;
  }

  public function traerUnLog($request, $response, $args){

	$arrayConToken = $request->getHeader('comandaToken');
	$token=$arrayConToken[0];			

	$payload= login::ObtenerPayLoad($token);
					
					// DELETE,PUT y DELETE sirve para todos los logeados y admin
					if($payload->data=="socios")
					{
						//$response = $next($request, $response);
						//$respuesta = "Es cocinero";
						$respuesta = 	$todosLosEmpleados=empleados::traerLogs();
					}		           	
					else
					{	
						$respuesta="Solo administradores usted es $payload->data ";
					}


	$newResponse = $response->withJson($respuesta, 200);  
	return $newResponse;

  }



}