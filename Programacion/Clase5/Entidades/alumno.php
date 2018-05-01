<?php
class Alumno
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $legajo;
 	private $nombre;
  	private $pathFoto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetLegajo()
	{
		return $this->legajo;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetPathFoto()
	{
		return $this->pathFoto;
	}

	public function SetLegajo($valor)
	{
		$this->legajo = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetPathFoto($valor)
	{
		$this->pathFoto = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($legajo=NULL, $nombre=NULL, $pathFoto=NULL)
	{
		if($legajo !== NULL && $nombre !== NULL){
			$this->legajo = $legajo;
			$this->nombre = $nombre;
			$this->pathFoto = $pathFoto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->legajo." - ".$this->nombre." - ".$this->pathFoto."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
	public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/alumnos.txt", "a");
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function TraerTodosLosAlumnos()
	{

		$ListaDeAlumnosLeidos = array();

		//leo todos los alumnos del archivo
		$archivo=fopen("archivos/alumnos.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$alumnos = explode(" - ", $archAux);
			$alumnos[0] = trim($alumnos[0]);
			if($alumnos[0] != ""){
				$ListaDeAlumnosLeidos[] = new Alumno($alumnos[0], $alumnos[1],$alumnos[2]);
			}
		}
		fclose($archivo);
		
		return $ListaDeAlumnosLeidos;
		
	}
	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$ListaDeAlumnosLeidos = Alumno::TraerTodosLosAlumnos();
		$ListaDeAlumnos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
			if($ListaDeAlumnosLeidos[$i]->legajo == $obj->legajo){//encontre el modificado, lo excluyo
				$imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->pathFoto);
				$ListaDeAlumnosLeidos[$i] = $obj;
				continue;
			}
			$ListaDeAlumnos[$i] = $ListaDeAlumnosLeidos[$i];
		}
		
		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/alumnos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeAlumnosLeidos AS $item){
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
	public static function Eliminar($legajo)
	{
		if($legajo === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeAlumnosLeidos = Alumno::TraerTodosLosAlumnos();
		$ListaDeAlumnos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
			if($ListaDeAlumnosLeidos[$i]->legajo == $legajo){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeAlumnos[$i] = $ListaDeAlumnosLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/alumnos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeAlumnos AS $item){
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