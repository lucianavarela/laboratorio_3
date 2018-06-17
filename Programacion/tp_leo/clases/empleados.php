<?php

require_once "clases/accesoDatos.php";
require_once "clases/login.php";

class empleados{

//--------------------------------------------------------------------------------//
//--ATRIBUTOS    

public $id;    
public $nombre;
public $turno;
public $tipo;
private $pass;





    //--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS

public function getid(){
    return $this->id;
}
public function setid($valor){
$this->id = $valor;
}


public function getnombre(){
    return $this->nombre;
}
public function setnombre($valor){
$this->nombre = $valor;
}

public function getturno(){
return $this->turno;
}
public function setturno($valor){
    $this->turno = $valor;
}

public function gettipo(){
    return $this->tipo;
    }
    
public function settipo($valor){
    $tipos = array("bartender", "cerveceros", "cocineros","mozos", "socios");
    if (in_array($valor, $tipos)) {
        $this->tipo = $valor;
        return true;
    } else {
        return false;
    }
}

public function getpass(){
    return $this->pass;
    }
    
public function setpass($valor){
    $this->pass = $valor;
}




//--------------------------------------------------------------------------------//

//--CONSTRUCTOR

/*public function __construct($nombre=NULL,$turno=NULL,$tipo=NULL,$pass=NULL)
{
    if($nombre !== NULL && $tipo !== NULL && $turno !== NULL ){
		$this->nombre = $nombre;
        $this->turno = $turno;
        $this->tipo = $tipo;
        $this->pass = $pass;		        
        
               

    }
}*/

//--------------------------------------------------------------------------------//
//--METODOS	
public function ToString()
{
    return $this->nombre." - ".$this->turno." - ".$this->tipo."\n";
}

//--------------------------------------------------------------------------------//


//--GUARDAR

public function Guardar()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (nombre,tipo,turno,pass)values('$this->nombre','$this->tipo','$this->turno','$this->pass')");
        $retorno =  $consulta->execute();   
        return $retorno;

}



public function BorrarId($id){

    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from empleados 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$retorno = $consulta->execute();
				return $consulta->rowCount();
               
  /*  $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM empleados WHERE id=$id  ");
    $retorno =  $consulta->execute(); */
    //$retorno = $consulta->rowCount();  
   // return $retorno;
}


public function Modificar($id)
{
    $retorno;
            
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("update empleados set nombre='$this->nombre' ,tipo='$this->tipo',turno='$this->turno' WHERE id='$id'  ");
       $retorno= $consulta->execute();
       return $retorno;    
     
}

public function TraerId($id){
    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados WHERE id='$id'");
    $consulta->execute(); 
    $retorno = $consulta->fetchObject('empleados'); 
    if($retorno != null){
        //var_dump($retorno);
        return $retorno;
    }
    else{
        return null;
    }
}

//---------Login-----------//




//verificar  tipo de usuario
public function verificarlogin($nombre,$pass){
   
    $retorno = null;

    
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados WHERE nombre='$nombre' AND pass='$pass'");
    $consulta->execute(); 
    $resultado = $consulta->fetchObject('empleados'); 
    
    if($resultado != null){
        $dato= $resultado->gettipo();
        $resultado->GuardarLogin();        
        $retorno= login::NuevoToken($dato);
    }   

    return $retorno;

}


//Guardar Login 
public function GuardarLogin(){
    $hoy = getdate();
    $fecha = $hoy["year"]."-".$hoy["mon"]."-".$hoy["mday"];
    $hora = $hoy["hours"].":".$hoy["minutes"].":".$hoy["seconds"];

    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into login (nombre,idEmpleado,tipo,fecha,hora)values('$this->nombre','$this->id','$this->tipo','$fecha','$hora')");
        $retorno =  $consulta->execute();   
        return $retorno;

}

//Traer todos los log si sos socios
public function traerLogs(){

    // $retorno;
     $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM login ");
      $consulta->execute(); 
     return $consulta->fetchAll(PDO::FETCH_CLASS, "empleados");	
     /*$retorno = $consulta->fetchAll(PDO::FETCH_CLASS, "empleados"); 
     if($retorno != null){
         return $retorno;
     }
     else{
         return null;
     }*/
 
 
 
 
 
 }







//--TRAER
public function traerTodos(){

   // $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados ");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_CLASS, "empleados");	
    /*$retorno = $consulta->fetchAll(PDO::FETCH_CLASS, "empleados"); 
    if($retorno != null){
        return $retorno;
    }
    else{
        return null;
    }*/





}


//--Consultar segun turno y tipo
public function Consultar($turno, $tipo){

    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados WHERE turno='$turno' AND tipo= '$tipo'  ");
    $consulta->execute(); 
    $retorno = $consulta->fetchAll(); 
    if($retorno != null){
        return $retorno;
    }
    else{
        return null;
    }





}


       



}


?>