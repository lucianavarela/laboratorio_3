<?php
class Login
{
    public static function UserLogin($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
        $usuario = Usuario::ValidarUsuario($ArrayDeParametros['nombre'], $ArrayDeParametros['clave']);
        if($usuario) {
            $token = AutentificadorJWT::CrearToken($usuario);
            $objDelaRespuesta = array(
                'token'=>$token,
            );
            return $response->withJson($objDelaRespuesta, 200);
        } else {
            $objDelaRespuesta= new stdclass();
			$objDelaRespuesta->respuesta='Usuario inexistente';
            return $response->withJson($objDelaRespuesta, 401);
        }
    }
}