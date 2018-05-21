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
	  	return $this->sabor." - ".$this->tipo." - ".$this->precio."\r\n";
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
		$consulta->execute();
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

	public static function TraerTodosLosHelados()
	{
		$ListaDeHeladosLeidos = array();
		//leo todos los helados del archivo
		$archivo=fopen("archivos/helados.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$helados = explode(" - ", $archAux);
			$helados[0] = trim($helados[0]);
			if($helados[0] != ""){
				$ListaDeHeladosLeidos[] = new Helado($helados[0], $helados[1],$helados[2]);
			}
		}
		fclose($archivo);
		
		return $ListaDeHeladosLeidos;
		
	}
	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$ListaDeHeladosLeidos = Helado::TraerTodosLosHelados();
		$ListaDeHelados = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeHeladosLeidos); $i++){
			if($ListaDeHeladosLeidos[$i]->sabor == $obj->sabor){//encontre el modificado, lo excluyo
				$imagenParaBorrar = trim($ListaDeHeladosLeidos[$i]->precio);
				$ListaDeHeladosLeidos[$i] = $obj;
				//continue;
			}
			//$ListaDeHelados[$i] = $ListaDeHeladosLeidos[$i];
		}

		//array_push($ListaDeHelados, $obj);//agrego el helado modificado
		
		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/helados.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeHeladosLeidos AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function Eliminar($sabor)
	{
		if($sabor === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeHeladosLeidos = Helado::TraerTodosLosHelados();
		$ListaDeHelados = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeHeladosLeidos); $i++){
			if($ListaDeHeladosLeidos[$i]->sabor == $sabor){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeHeladosLeidos[$i]->precio);
				continue;
			}
			$ListaDeHelados[$i] = $ListaDeHeladosLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/helados.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeHelados AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
//--------------------------------------------------------------------------------//
}