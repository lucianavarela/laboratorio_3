<?php
class Cliente
{
	private $correo;
	private $nombre;
	private $clave;
	
	public function GetCorreo()
	{
		return $this->correo;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetClave()
	{
		return $this->clave;
	}
	public function SetCorreo($value)
	{
		$this->correo = $value;
	}
	public function SetNombre($value)
	{
		$this->nombre = $value;
	}
	public function SetClave($value)
	{
		$this->clave = $value;
	}

	public function __construct($correo=NULL, $nombre=NULL, $clave=NULL)
	{
		if($correo !== NULL && $nombre !== NULL && $clave !== NULL){
			$this->correo = $correo;
			$this->nombre = $nombre;
			$this->clave = trim($clave);
		}
	}
	
  	public function ToString()
	{
	  	return $this->correo." - ".$this->nombre." - ".$this->clave."\r\n";
	}

	public static function Guardar($cliente)
	{
		$resultado = FALSE;
		$ar = fopen("clientes/clientesActuales.txt", "a");
		$cant = fwrite($ar, $cliente->ToString());
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		return $resultado;
	}

	public static function TraerTodosLosClientes()
	{
		$ListaDeClientes = array();
		$archivo=fopen("clientes/clientesActuales.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$clientes = explode(" - ", $archAux);
			$clientes[0] = trim($clientes[0]);
			if($clientes[0] != ""){
				$ListaDeClientes[] = new Cliente($clientes[0], $clientes[1], $clientes[2]);
			}
		}
		fclose($archivo);
		return $ListaDeClientes;
	}

	public static function ValidarCliente ($correo) {
		$cliente = Cliente::GetCliente($correo);
		if ($cliente !== NULL) {
			return $cliente->GetClave();
		}
		return null;
	}
	
	public static function GetCliente ($correo) {
		$clientes = Cliente::TraerTodosLosClientes();
		foreach ($clientes as $cliente) {
			if ($cliente->correo == $correo) {
				return $cliente;
			}
		}
		return null;
	}

	public static function Listar () {
        $clientes = Cliente::TraerTodosLosClientes();
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Clientes</h2>
            <table><tr><th>Legajo</th><th>Nombre</th><th>Foto</th></tr>";

        foreach ($clientes as $cliente) {
            $file = 'archivos/'.$cliente->GetPathFoto();
            $content = $content."<tr><th>".$cliente->GetLegajo()."</th><th>".$cliente->GetNombre()."</th>
            <th><img src=\"".$file."\"></th></tr>";
        }
        $content = $content."</table>";
        print($content);
    }

	public function Modificar($new_values)
	{
		$ListaDeClientes = Cliente::TraerTodosLosClientes();
		
		for($i=0; $i<count($ListaDeClientes); $i++){
			if($ListaDeClientes[$i]->GetCorreo() == $new_values["correo"]) {
				unset($ListaDeClientes[$i]);
				break;
			}
		}
		$new_cliente = new Cliente ($new_values['correo'], $new_values['nombre'], $new_values['clave']);
		array_push($ListaDeClientes, $new_cliente);

		$archivo = fopen("archivos/clientes.txt", "w");
		foreach($ListaDeClientes as $cliente){
			$cant = fwrite($archivo, $cliente->ToString());
			if($cant < 1)
			{
				return false;
			}
		}
		fclose($archivo);
		return true;
	}
}