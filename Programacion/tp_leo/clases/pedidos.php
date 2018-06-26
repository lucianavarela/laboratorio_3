<?php

require_once "clases/accesoDatos.php";

class pedidos{

//--------------------------------------------------------------------------------//
//--ATRIBUTOS    

public $id;    
public $codigo;
public $estado;
public $cliente;



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
$
    $this->codigo = str_shuffle($valor);
}

public function getestado(){
return $this->estado;
}

public function setestado($valor){
    $estados = array("pendientes", "en preparacion", "listo para servir", "entregado");
    if (in_array($valor, $estados)) {
        $this->estado = $valor;
        return true;
    } else {
        return false;
    }
}

public function getcliente(){
    return $this->cliente;
}
public function setcliente($valor){
$this->cliente = $valor;
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
     $dato =pedidos::verificarMesa($this->cliente);     

        if($dato === null){

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (cliente,codigo,estado)values('$this->cliente','$this->codigo','$this->estado')");
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
				from pedidos 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$retorno = $consulta->execute();
				return $consulta->rowCount();
    
 
}


public function Modificarestado()
{
    $retorno;
      
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("update pedidos set estado='$this->estado' WHERE id='$this->id' ");
       $retorno= $consulta->execute();
       return $retorno;    
     
}

public function TraerId($id){
    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM pedidos WHERE id='$id'");
    $consulta->execute(); 
    $retorno = $consulta->fetchObject('pedidos'); 
    if($retorno != null){
        //var_dump($retorno);
        return $retorno;
    }
    else{
        return null;
    }
}





public function verificarMesa($cliente){
   
    $retorno;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM pedidos WHERE cliente='$cliente'");
    $consulta->execute(); 
    $resultado = $consulta->fetchObject('pedidos'); 
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
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM pedidos ");
    $consulta->execute(); 
    return $consulta->fetchAll(PDO::FETCH_CLASS, "pedidos");	
    /*$retorno = $consulta->fetchAll(PDO::FETCH_CLASS, "pedidos"); 
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
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM pedidos WHERE estado='$estado' AND tipo= '$tipo'  ");
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