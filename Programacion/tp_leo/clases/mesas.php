<?php

require_once "clases/accesoDatos.php";

class mesas{

//--------------------------------------------------------------------------------//
//--ATRIBUTOS    

public $id;    
public $codigo;
public $estado;
public $numero;



    //--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS

public function getid(){
    return $this->id;
}
public function setid($valor){
$this->id = $valor;
}


public function getcodigo(){
    return $this->codigo;
}

public function setcodigo($valor){
$cant = strlen($valor);
if($cant <2 ){
    $this->codigo = str_shuffle("XOLT").$valor;
}
elseif(strlen($valor)<3){
    $this->codigo = str_shuffle("MYA").$valor;
}
else{
    $this->codigo = str_shuffle("ZB").$valor;
}

    
}

public function getestado(){
return $this->estado;
}

public function setestado($valor){
    $estados = array("con cliente esperando pedido", "con cliente comiendo", "con cliente pagando", "cerrada");
    if (in_array($valor, $estados)) {
        $this->estado = $valor;
        return true;
    } else {
        return false;
    }
}

public function getnumero(){
    return $this->numero;
}
public function setnumero($valor){
$this->numero = $valor;
}




//--------------------------------------------------------------------------------//

//--CONSTRUCTOR

/*public function __construct($codigo=NULL,$estado=NULL)
{
    if($codigo !== NULL  && $estado !== NULL ){
		$this->codigo = $codigo;
        $this->estado = $estado;
    }
}*/



//--------------------------------------------------------------------------------//
//--METODOS	
public function ToString()
{
    return $this->codigo." - ".$this->estado."\n";
}

//--------------------------------------------------------------------------------//


//--GUARDAR

public function Guardar()
{       
     $dato =mesas::verificarMesa($this->numero);     

        if($dato === null){

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mesas (numero,codigo,estado)values('$this->numero','$this->codigo','$this->estado')");
            $retorno = $consulta->execute();  
            //$retorno = "HOLA"; 
        }
        else{

           $retorno = $this->Modificar($dato->id);
        }

        return $retorno;

}



public function BorrarId($id){

    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from mesas 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$retorno = $consulta->execute();
				return $consulta->rowCount();
    
 
}


public function Modificarestado()
{
    $retorno;
      
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("update mesas set estado='$this->estado' WHERE id='$this->id' ");
       $retorno= $consulta->execute();
       return $retorno;    
     
}

public function TraerId($id){
    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesas WHERE id='$id'");
    $consulta->execute(); 
    $retorno = $consulta->fetchObject('mesas'); 
    if($retorno != null){
        //var_dump($retorno);
        return $retorno;
    }
    else{
        return null;
    }
}





public function verificarMesa($numero){
   
    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesas WHERE numero='$numero'");
    $consulta->execute(); 
    $resultado = $consulta->fetchObject('mesas'); 
    if($resultado ){
        
        return $resultado;
    }
    else{
        //$retorno = null;
    }
    
   // return $retorno;
}

//--TRAER
public function traerTodos(){

   // $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesas ");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_CLASS, "mesas");	
    /*$retorno = $consulta->fetchAll(PDO::FETCH_CLASS, "mesas"); 
    if($retorno != null){
        return $retorno;
    }
    else{
        return null;
    }*/





}


//--Consultar segun estado y tipo
public function Consultar($estado, $tipo){

    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesas WHERE estado='$estado' AND tipo= '$tipo'  ");
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