<?php
class Venta
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $fecha;
	protected $importe;
    protected $cantidad;
    protected $idHelado;
    protected $idLocal;
    protected $idEmpleado;
    protected $idCliente;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetSabor()
	{
		return $this->sabor;
	}
	public function GetFecha()
	{
		return $this->fecha;
	}
	public function GetImporte()
	{
		return $this->importe;
	}
	public function GetCantidad()
	{
		return $this->cantidad;
	}

	public function SetSabor($valor)
	{
		$this->sabor = $valor;
	}
	public function SetFecha($valor)
	{
		$this->fecha = $valor;
	}
	public function SetImporte($valor)
	{
		$this->importe = $valor;
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
	  	return $this->sabor." - ".$this->fecha." - ".$this->cantidad." - ".$this->importe."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Nuevo($sabor, $fecha, $importe, $cantidad) {
		$venta_nueva = new Venta();
		$venta_nueva->sabor = $sabor;
		$venta_nueva->fecha = $fecha;
		$venta_nueva->importe = (float)$importe;
		$venta_nueva->cantidad = (float)$cantidad;
		return $venta_nueva;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ventas (sabor, fecha, importe, cantidad)values('$this->sabor','$this->fecha','$this->importe','$this->cantidad');");
		try {
			$consulta->execute();
		} catch (Exception $e) {
            print "Error!: " . $e->getMessage(); 
            die();
        }
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function ValidarId ($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas WHERE id='$id';");
		$consulta->execute();
		$ventaBuscado = $consulta->fetchObject("Venta");
		var_dump($ventaBuscado);
		return $ventaBuscado;
	}
}