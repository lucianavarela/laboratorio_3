<?php
class Local
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $dirección;
	protected $estado;
	protected $idLocalidad;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetDirección()
	{
		return $this->dirección;
	}
	public function GetEstado()
	{
		return $this->estado;
	}
	public function GetLocalidad()
	{
		return $this->idLocalidad;
	}

	public function SetDirección($valor)
	{
		$this->dirección = $valor;
	}
	public function SetEstado($valor)
	{
		$this->estado = $valor;
	}
	public function SetLocalidad($valor)
	{
		$this->idLocalidad = $valor;
	}

	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct()
	{}

//--------------------------------------------------------------------------------//
//--TOSTRING
  	public function ToString()
	{
	  	return $this->dirección." - ".$this->estado." - ".$this->idLocalidad."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Nuevo($dirección, $estado, $idLocalidad) {
		$local_nuevo = new Local();
		$local_nuevo->dirección = $dirección;
		$local_nuevo->estado = $estado;
		$local_nuevo->idLocalidad = (float)$idLocalidad;
		return $local_nuevo;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into local (dirección, estado, idLocalidad)values('$this->dirección','$this->estado','$this->idLocalidad');");
		try {
			$consulta->execute();
		} catch (Exception $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function Validar ($dirección, $estado) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from local WHERE dirección='$dirección' AND estado='$estado';");
		$consulta->execute();
		$localBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Local");
		if(sizeof($localBuscado) == 1) {
			return "Existe";
		} else {
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from local WHERE dirección='$dirección' OR estado='$estado';");
			$consulta->execute();
			$localBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Local");
			if(sizeof($localBuscado) > 0) {
				return "El dirección o el estado ya existen";
			} else {
				return "No existe";
			}
		}
	}
	
	public static function ValidarId ($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from local WHERE id='$id';");
		$consulta->execute();
		$localBuscado = $consulta->fetchObject("Local");
		return $localBuscado;
	}
}