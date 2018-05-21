<?php
class Cliente
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $nombre;
	protected $nacionalidad;
	protected $sexo;
	protected $edad;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetNacionalidad()
	{
		return $this->nacionalidad;
	}
	public function GetSexo()
	{
		return $this->sexo;
	}
	public function GetEdad()
	{
		return $this->edad;
	}

	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetNacionalidad($valor)
	{
		$this->nacionalidad = $valor;
	}
	public function SetSexo($valor)
	{
		$this->sexo = $valor;
	}
	public function SetEdad($valor)
	{
		$this->edad = $valor;
	}

	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct()
	{}

//--------------------------------------------------------------------------------//
//--TOSTRING
  	public function ToString()
	{
	  	return $this->nombre." - ".$this->nacionalidad." - ".$this->edad." - ".$this->sexo."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Nuevo($nombre, $nacionalidad, $sexo, $edad) {
		$cliente_nuevo = new Cliente();
		$cliente_nuevo->nombre = $nombre;
		$cliente_nuevo->nacionalidad = $nacionalidad;
		$cliente_nuevo->sexo = $sexo;
		$cliente_nuevo->edad = (int)$edad;
		return $cliente_nuevo;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into clientes (nombre, nacionalidad, sexo, edad)values('$this->nombre','$this->nacionalidad','$this->sexo','$this->edad');");
        try {
            $consulta->execute();
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function Validar ($nombre, $nacionalidad) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from clientes WHERE nombre='$nombre' AND nacionalidad='$nacionalidad';");
		$consulta->execute();
		$clienteBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Cliente");
		if(sizeof($clienteBuscado) == 1) {
			return "Existe";
		} else {
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from clientes WHERE nombre='$nombre' OR nacionalidad='$nacionalidad';");
			$consulta->execute();
			$clienteBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Cliente");
			if(sizeof($clienteBuscado) > 0) {
				return "El nombre o el nacionalidad ya existen";
			} else {
				return "No existe";
			}
		}
	}
	
	public static function ValidarId ($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from clientes WHERE id='$id';");
		$consulta->execute();
		$clienteBuscado = $consulta->fetchObject("Cliente");
		return $clienteBuscado;
	}
}