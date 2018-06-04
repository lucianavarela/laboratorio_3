<?php
class tabla
{
	public $id;
 	public $valorChar;
  	public $valorDate;
  	public $valorInt;



  	public function BorrarCd()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from tabla 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_valorInt);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public static function BorrarCdPorvalorInt($valorInt)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from tabla 				
				WHERE valorInt=:valorInt");	
				$consulta->bindValue(':valorInt',$valorInt, PDO::PARAM_valorInt);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	public function ModificarCd()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update valorDate tabla 
				set valorChar='$this->valorChar',
				valorDate='$this->valorDate',
				valorInt='$this->valorInt'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarElCd()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT valorInto tabla (valorChar,valorDate,valorInt)values('$this->valorChar','$this->valorDate','$this->valorInt')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarCdParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update valorDate tabla 
				set valorChar=:valorChar,
				valorDate=:valorDate,
				valorInt=:valorInt
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_valorInt);
			$consulta->bindValue(':valorChar',$this->valorChar, PDO::PARAM_valorInt);
			$consulta->bindValue(':valorInt', $this->valorInt, PDO::PARAM_STR);
			$consulta->bindValue(':valorDate', $this->valorDate, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElCdParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT valorInto tabla (valorChar,valorDate,valorInt)values(:valorChar,:valorDate,:valorInt)");
				$consulta->bindValue(':valorChar',$this->valorChar, PDO::PARAM_valorInt);
				$consulta->bindValue(':valorInt', $this->valorInt, PDO::PARAM_STR);
				$consulta->bindValue(':valorDate', $this->valorDate, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function GuardarCD()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarCdParametros();
	 		}else {
	 			$this->InsertarElCdParametros();
	 		}

	 }


  	public static function TraerTodoLostabla()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,valorChar as valorChar, valorDate as valorDate,valorInt as valorInt from tabla");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}

	public static function TraerUnCd($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, valorChar as valorChar, valorDate as valorDate,valorInt as valorInt from tabla where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
			return $cdBuscado;				

			
	}

	public static function TraerUnCdvalorInt($id,$valorInt) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  valorChar as valorChar, valorDate as valorDate,valorInt as valorInt from tabla  WHERE id=? AND valorInt=?");
			$consulta->execute(array($id, $valorInt));
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}

	public static function TraerUnCdvalorIntParamNombre($id,$valorInt) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  valorChar as valorChar, valorDate as valorDate,valorInt as valorInt from tabla  WHERE id=:id AND valorInt=:valorInt");
			$consulta->bindValue(':id', $id, PDO::PARAM_valorInt);
			$consulta->bindValue(':valorInt', $valorInt, PDO::PARAM_STR);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}
	
	public static function TraerUnCdvalorIntParamNombreArray($id,$valorInt) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  valorChar as valorChar, valorDate as valorDate,valorInt as valorInt from tabla  WHERE id=:id AND valorInt=:valorInt");
			$consulta->execute(array(':id'=> $id,':valorInt'=> $valorInt));
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->valorChar."  ".$this->valorDate."  ".$this->valorInt;
	}

}