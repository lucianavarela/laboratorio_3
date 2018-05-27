<?php
class Venta
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	protected $id;
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

	public static function Nuevo($local,$cliente,$empleado,$helado,$cantidad,$importe) {
		$venta_nueva = new Venta();
		$venta_nueva->idHelado = (int)$helado;
		$venta_nueva->idLocal = (int)$local;
		$venta_nueva->idCliente = (int)$cliente;
		$venta_nueva->idEmpleado = (int)$empleado;
		$venta_nueva->cantidad = (float)$cantidad;
		$venta_nueva->importe = (float)$importe;
		$venta_nueva->fecha = date("Y-m-d H:i:s");
		return $venta_nueva;
	}

	public function Guardar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (idHelado, idLocal, idCliente, idEmpleado, fecha, cantidad, importe)values('$this->idHelado', '$this->idLocal', '$this->idCliente', '$this->idEmpleado', '$this->fecha', '$this->cantidad', '$this->importe');");
		try {
			$consulta->execute();
			Helado::ValidarId($this->idHelado)->GestionarVenta($this->cantidad);
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