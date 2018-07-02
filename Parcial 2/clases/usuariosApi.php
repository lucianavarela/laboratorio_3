<?php
require_once 'usuarios.php';
require_once 'IApiUsable.php';
class usuariosApi extends Usuario implements IApiUsable
{
	/*/Cargo el log
	if ($request->getAttribute('empleado')) {
		$new_log = new Log();
		$new_log->idEmpleado = $request->getAttribute('empleado')->id;
		$new_log->accion = "Ver usuarios";
		$new_log->GuardarLog();
	}
	/*/
	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$usuarioObj=Usuario::TraerUsuario($id);
		$newResponse = $response->withJson($usuarioObj, 200);  
		return $newResponse;
	}

	public function TraerTodos($request, $response, $args) {
		$usuarios=Usuario::TraerUsuarios();
		$newResponse = $response->withJson($usuarios, 200);  
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		if ($ArrayDeParametros['nombre'] && $ArrayDeParametros['clave'] && $ArrayDeParametros['nivel']) {
			if ($ArrayDeParametros['nivel'] == 'usuario' || $ArrayDeParametros['nivel'] == 'admin') {
				$miusuario = new Usuario();
				$miusuario->nombre = $ArrayDeParametros['nombre'];
				$miusuario->clave = $ArrayDeParametros['clave'];
				$miusuario->nivel = $ArrayDeParametros['nivel'];
				$miusuario->GuardarUsuario();
				$objDelaRespuesta= new stdclass();
				$objDelaRespuesta->respuesta="Usuario creada!";
				return $response->withJson($objDelaRespuesta, 200);
			} else {
				$objDelaRespuesta= new stdclass();
				$objDelaRespuesta->respuesta="El nivel debe ser admin o usuario";
				return $response->withJson($objDelaRespuesta, 401);
			}
		} else {
			$objDelaRespuesta= new stdclass();
			$objDelaRespuesta->respuesta="Parametros faltantes";
			return $response->withJson($objDelaRespuesta, 401);
		}
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$usuario= new Usuario();
		$usuario->id=$id;
		$cantidadDeBorrados=$usuario->BorrarUsuario();

		$objDelaRespuesta= new stdclass();
		if($cantidadDeBorrados>0) {
			$objDelaRespuesta->respuesta="Usuario eliminada";
			return $response->withJson($objDelaRespuesta, 200);
		} else {
			$objDelaRespuesta->respuesta="Error eliminando la usuario";
			return $response->withJson($objDelaRespuesta, 400);
		}
	}
		
	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$miusuario = new Usuario();
		$miusuario->id=$args['id'];
		$miusuario->nombre=$ArrayDeParametros['nombre'];
		$miusuario->clave=$ArrayDeParametros['clave'];
		$miusuario->nivel=$ArrayDeParametros['nivel'];
		$miusuario->GuardarUsuario();
		return $response->withJson($miusuario, 200);		
	}
}