<?php
class Empleado
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $id;
	protected $nombre;
	protected $tipo;
	protected $turno;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetTipo()
	{
		return $this->tipo;
	}
	public function GetTurno()
	{
		return $this->turno;
	}

	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetTipo($valor)
	{
		$this->tipo = $valor;
	}
	public function SetTurno($valor)
	{
		$this->turno = $valor;
	}

	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct()
	{}

//--------------------------------------------------------------------------------//
//--TOSTRING
  	public function ToString()
	{
	  	return $this->nombre." - ".$this->tipo." - ".$this->turno."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Nuevo($nombre, $tipo, $turno) {
		$empleado_nuevo = new Empleado();
		$empleado_nuevo->nombre = $nombre;
		$empleado_nuevo->tipo = $tipo;
		$empleado_nuevo->turno = $turno;
		return $empleado_nuevo;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre, tipo, turno)values('$this->nombre','$this->tipo','$this->turno');");
		try {
			$consulta->execute();
		} catch (Exception $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function Validar ($nombre, $tipo) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from empleado WHERE nombre='$nombre' AND tipo='$tipo';");
		$consulta->execute();
		$empleadoBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");
		if(sizeof($empleadoBuscado) == 1) {
			return "Existe";
		} else {
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from empleado WHERE nombre='$nombre' OR tipo='$tipo';");
			$consulta->execute();
			$empleadoBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");
			if(sizeof($empleadoBuscado) > 0) {
				return "El nombre o el tipo ya existen";
			} else {
				return "No existe";
			}
		}
	}

	public static function ValidarId ($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from empleado WHERE id='$id';");
		$consulta->execute();
		$empleadoBuscado = $consulta->fetchObject("Empleado");
		return $empleadoBuscado;
	}
}