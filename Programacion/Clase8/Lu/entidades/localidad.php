<?php
class Localidad
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $nombre;
	protected $estado;
	protected $provincia;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetEstado()
	{
		return $this->estado;
	}
	public function GetProvincia()
	{
		return $this->provincia;
	}

	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetEstado($valor)
	{
		$this->estado = $valor;
	}
	public function SetProvincia($valor)
	{
		$this->provincia = $valor;
	}

	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct()
	{}

//--------------------------------------------------------------------------------//
//--TOSTRING
  	public function ToString()
	{
	  	return $this->nombre." - ".$this->estado." - ".$this->provincia."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Nueva($nombre, $provincia, $estado) {
		$provincia_nueva = new Localidad();
		$provincia_nueva->nombre = $nombre;
		$provincia_nueva->estado = $estado;
		$provincia_nueva->provincia = $provincia;
		return $provincia_nueva;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into localidad (nombre, estado, provincia)values('$this->nombre','$this->estado','$this->provincia');");
		try {
			$consulta->execute();
		} catch (Exception $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function Validar ($nombre, $estado) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from localidad WHERE nombre='$nombre' AND estado='$estado';");
		$consulta->execute();
		$provinciaBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Localidad");
		if(sizeof($provinciaBuscado) == 1) {
			return "Existe";
		} else {
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from localidad WHERE nombre='$nombre' OR estado='$estado';");
			$consulta->execute();
			$provinciaBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Localidad");
			if(sizeof($provinciaBuscado) > 0) {
				return "El nombre o el estado ya existen";
			} else {
				return "No existe";
			}
		}
	}
}