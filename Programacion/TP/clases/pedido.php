<?php
class Pedido
{
    public $id;
    public $param1;
    public $param2;
    public $param3;
    
    public function BorrarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from pedidos
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update pedidos 
            set param1='$this->param1',
            param2='$this->param2',
            param3='$this->param3'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarPedido() {
        if ($this->id > 0) {
            $this->ModificarPedido();
        } else {
            $this->InsertarPedido();
        }
    }

    public static function TraerPedidos() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from pedidos");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
    }

    public static function TraerPedido($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from pedidos where id = $id");
        $consulta->execute();
        $pedidoResultado= $consulta->fetchObject('Pedido');
        return $pedidoResultado;
    }

    public function toString() {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}