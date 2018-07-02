<?php
class Login
{
    public static function UserLogin($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		if ($ArrayDeParametros['nombre'] && $ArrayDeParametros['clave'] && $ArrayDeParametros['sexo']) {
            $usuario = Usuario::ValidarUsuario($ArrayDeParametros['nombre'], $ArrayDeParametros['clave'], $ArrayDeParametros['sexo']);
            if($usuario) {
                $token = AutentificadorJWT::CrearToken($usuario);
                $objDelaRespuesta = array(
                    'token'=>$token,
                );
                return $response->withJson($objDelaRespuesta, 200);
            } else {
                $usuarios=Usuario::TraerUsuarios();
                foreach ($usuarios as $usuario) {
                    if ($usuario->nombre == $ArrayDeParametros['nombre']) {
                        $objDelaRespuesta= new stdclass();
                        $objDelaRespuesta->respuesta='Clave o sexo incorrectos';
                        return $response->withJson($objDelaRespuesta, 401);
                    }
                }
                $objDelaRespuesta= new stdclass();
                $objDelaRespuesta->respuesta='Nombre inexistente';
                return $response->withJson($objDelaRespuesta, 401);
            }
        } else {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->respuesta='Parametros faltantes';
            return $response->withJson($objDelaRespuesta, 401);
        }
    }
}