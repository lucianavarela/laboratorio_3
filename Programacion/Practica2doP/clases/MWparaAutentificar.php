<?php
class MWparaAutentificar
{
	public function CargarLog($request, $response, $next) {
		$usuario = $request->getAttribute('usuario');
		if ($usuario) {
			$datetime_now = date("Y-m-d H:i:s");
			$metodo = "";
			if ($request->isGet()) {
				$metodo = "GET";
			} else {
				$metodo = "POST";
			}
			$ruta = $_SERVER['REQUEST_URI'];
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into logs (usuario,metodo,ruta,hora)values('$usuario->id','$metodo','$ruta', '$datetime_now');");
			$consulta->execute();
		}
		$response = $next($request, $response);
        return $response;
	}

 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
	public function VerificarUsuario($request, $response, $next) {
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
		$objDelaRespuesta->esValido=false;
		if($request->isGet() || $request->isPost()) {
			$arrayConToken = $request->getHeader('token');
			if($arrayConToken) {
				$token=$arrayConToken[0];
				try {
					AutentificadorJWT::verificarToken($token);
					$objDelaRespuesta->esValido=true;
				} catch (Exception $e) {
					$objDelaRespuesta->excepcion=$e->getMessage();
					$objDelaRespuesta->esValido=false;
				}
			}
			if($objDelaRespuesta->esValido) {
				$payload=AutentificadorJWT::ObtenerData($token);
				$request = $request->withAttribute('usuario', $payload);
			}
            $response = $next($request, $response);
		} else {
            $arrayConToken = $request->getHeader('token');
            $token=$arrayConToken[0];
            $objDelaRespuesta->esValido=true;
            
			try {
				AutentificadorJWT::verificarToken($token);
				$objDelaRespuesta->esValido=true;
			} catch (Exception $e) {
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;
			}
			if($objDelaRespuesta->esValido) {
				$payload=AutentificadorJWT::ObtenerData($token);
				if($payload->nivel=="admin")
				{
					$response = $next($request, $response);
				}
				else
				{
					$objDelaRespuesta->respuesta="Solo admins";
				}
			} else {
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
				$objDelaRespuesta->elToken=$token;
			}
		}
        
        if($objDelaRespuesta->respuesta!="") {
			$nueva=$response->withJson($objDelaRespuesta, 401);
			return $nueva;
        }

        return $response;
	}
	
	public function VerificarToken($request, $response, $next) {
        
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
		$arrayConToken = $request->getHeader('token');
		$token=$arrayConToken[0];
		$objDelaRespuesta->esValido=true;
		
		try {
			AutentificadorJWT::verificarToken($token);
			$objDelaRespuesta->esValido=true;
		} catch (Exception $e) {
			$objDelaRespuesta->excepcion=$e->getMessage();
			$objDelaRespuesta->esValido=false;
		}
		if($objDelaRespuesta->esValido) {
			$payload=AutentificadorJWT::ObtenerData($token);
			$request = $request->withAttribute('usuario', $payload);
			$response = $next($request, $response);
		} else {
			$objDelaRespuesta->respuesta="Por favor logueese para realizar esta accion!";
			$objDelaRespuesta->elToken=$token;
		}
        
        if($objDelaRespuesta->respuesta!="") {
			$nueva=$response->withJson($objDelaRespuesta, 401);
			return $nueva;
        }

        return $response;
	}

	public function VerificarAdmin($request, $response, $next) {
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
		$nivel = $request->getAttribute('usuario')->nivel;
		if($nivel == "admin") {
			$response = $next($request, $response);
		}
		else
		{
			$objDelaRespuesta->respuesta="Solo admins";
		}
        
        if($objDelaRespuesta->respuesta!="") {
			$nueva=$response->withJson($objDelaRespuesta, 401);
			return $nueva;
        }

        return $response;
	}

	public function FiltrarVentas($request, $response, $next) {
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
		$usuario = $request->getAttribute('usuario');
		$nivel = $usuario->nivel;
		if($nivel == "usuario") {
			$response = $next($request, $response);
			$ventas = json_decode($response->getBody()->__toString());
			if (is_array($ventas)) {
				foreach ($ventas as $key => $venta) {
					if ($venta->usuario != $usuario->id) {
						unset($ventas[$key]);
					}
				}
			} else {
				if ($ventas->nivel != $nivel) {
					$ventas = [];
				}
			}
			$nueva=$response->withJson($ventas, 200);
			return $nueva;
		} else if($nivel == "admin") {
			$response = $next($request, $response);
			return $response;
		} else {
			$objDelaRespuesta->respuesta="Solo usuarios";
		}
        
        if($objDelaRespuesta->respuesta!="") {
			$nueva=$response->withJson($objDelaRespuesta, 401);
			return $nueva;
        }

        return $response;
	}
}