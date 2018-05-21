<?php
class Usuario
{
	private $email;
	private $nombre;
	private $perfil;
	private $edad;
	private $clave;
	
	public function GetEmail()
	{
		return $this->email;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetPerfil()
	{
		return $this->perfil;
	}
	public function GetEdad()
	{
		return $this->edad;
	}
	public function GetClave()
	{
		return $this->clave;
	}
	public function SetEmail($value)
	{
		$this->email = $value;
	}
	public function SetNombre($value)
	{
		$this->nombre = $value;
	}
	public function SetPerfil($value)
	{
		$this->perfil = $value;
	}
	public function SetEdad($value)
	{
		$this->edad = $value;
	}
	public function SetClave($value)
	{
		$this->clave = $value;
	}

	public function __construct($email=NULL, $nombre=NULL, $perfil=NULL, $edad=NULL, $clave=NULL)
	{
		if($email !== NULL && $nombre !== NULL && $edad !== NULL && $clave !== NULL && $perfil !== NULL){
			$this->email = $email;
			$this->nombre = $nombre;
			$this->perfil = $perfil;
			$this->edad = $edad;
			$this->clave = trim($clave);
		}
	}
	
  	public function ToString()
	{
	  	return $this->email." - ".$this->nombre." - ".$this->perfil." - ".$this->edad." - ".$this->clave."\r\n";
	}

	public static function Guardar($obj)
	{
		$resultado = FALSE;
		$ar = fopen("archivos/usuarios.txt", "a");
		$cant = fwrite($ar, $obj->ToString());
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		return $resultado;
	}

	public static function TraerTodosLosUsuarios()
	{
		$ListaDeUsuarios = array();
		$archivo=fopen("archivos/usuarios.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$usuarios = explode(" - ", $archAux);
			$usuarios[0] = trim($usuarios[0]);
			if($usuarios[0] != ""){
				$ListaDeUsuariosLeidos[] = new Usuario($usuarios[0], $usuarios[1], $usuarios[2], $usuarios[3], $usuarios[4]);
			}
		}
		fclose($archivo);
		return $ListaDeUsuariosLeidos;
	}

	public static function ValidarUsuario ($email) {
		$usuario = Usuario::GetUsuario($email);
		if ($usuario !== NULL) {
			return $user->GetClave();
		}
		return null;
	}
	
	public static function GetUsuario ($email) {
		$usuarios = Usuario::TraerTodosLosUsuarios();
		foreach ($usuarios as $user) {
			if ($user->email == $email) {
				return $user;
			}
		}
		return null;
	}

	public static function Listar () {
        $usuarios = Usuario::TraerTodosLosUsuarios();
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Usuarios</h2>
            <table><tr><th>Legajo</th><th>Nombre</th><th>Foto</th></tr>";

        foreach ($usuarios as $usuario) {
            $file = 'archivos/'.$usuario->GetPathFoto();
            $content = $content."<tr><th>".$usuario->GetLegajo()."</th><th>".$usuario->GetNombre()."</th>
            <th><img src=\"".$file."\"></th></tr>";
        }
        $content = $content."</table>";
        print($content);
    }

	public function Modificar($new_values)
	{
		$ListaDeUsuarios = Usuario::TraerTodosLosUsuarios();
		
		for($i=0; $i<count($ListaDeUsuarios); $i++){
			if($ListaDeUsuarios[$i]->GetEmail() == $new_values["email"]) {
				unset($ListaDeUsuarios[$i]);
				break;
			}
		}
		$new_user = new Usuario ($new_values['email'], $new_values['nombre'], $new_values['perfil'], $new_values['edad'], $new_values['clave']);
		array_push($ListaDeUsuarios, $new_user);

		$archivo = fopen("archivos/usuarios.txt", "w");
		foreach($ListaDeUsuarios as $user){
			$cant = fwrite($archivo, $user->ToString());
			if($cant < 1)
			{
				return false;
			}
		}
		fclose($archivo);
		return true;
	}
}