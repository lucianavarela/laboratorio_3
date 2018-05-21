<?php
class Helado
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $sabor;
	protected $tipo;
	protected $precio;
	protected $cantidad;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetSabor()
	{
		return $this->sabor;
	}
	public function GetTipo()
	{
		return $this->tipo;
	}
	public function GetPrecio()
	{
		return $this->precio;
	}
	public function GetCantidad()
	{
		return $this->cantidad;
	}

	public function SetSabor($valor)
	{
		$this->sabor = $valor;
	}
	public function SetTipo($valor)
	{
		$this->tipo = $valor;
	}
	public function SetPrecio($valor)
	{
		$this->precio = $valor;
	}
	public function SetCantidad($valor)
	{
		$this->cantidad = $valor;
	}

	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct()
	{}

//--------------------------------------------------------------------------------//
//--TOSTRING
  	public function ToString()
	{
	  	return $this->sabor." - ".$this->tipo." - ".$this->cantidad." - ".$this->precio."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Nuevo($sabor, $tipo, $precio, $cantidad) {
		$helado_nuevo = new Helado();
		$helado_nuevo->sabor = $sabor;
		$helado_nuevo->tipo = $tipo;
		$helado_nuevo->precio = (float)$precio;
		$helado_nuevo->cantidad = (float)$cantidad;
		return $helado_nuevo;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into helados (sabor, tipo, precio, cantidad)values('$this->sabor','$this->tipo','$this->precio','$this->cantidad');");
		try {
			$consulta->execute();
		} catch (Exception $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function Validar ($sabor, $tipo) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from helados WHERE sabor='$sabor' AND tipo='$tipo';");
		$consulta->execute();
		$heladoBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Helado");
		if(sizeof($heladoBuscado) == 1) {
			return "Existe";
		} else {
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from helados WHERE sabor='$sabor' OR tipo='$tipo';");
			$consulta->execute();
			$heladoBuscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Helado");
			if(sizeof($heladoBuscado) > 0) {
				return "El sabor o el tipo ya existen";
			} else {
				return "No existe";
			}
		}
	}

	public static function ValidarId ($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from helados WHERE id='$id';");
		$consulta->execute();
		$heladoBuscado = $consulta->fetchObject("Helado");
		var_dump($heladoBuscado);
		return $heladoBuscado;
	}
}