<?php
class Pedido
{
    protected $id;
    protected $idComanda;
    protected $sector;
    protected $idEmpleado;
    protected $descripcion;
    protected $terminado;
    
    
    public function GetIdComanda() {
        return $this->idComanda;
    }
    public function GetSector() {
        return $this->sector;
    }
    public function GetIdEmpleado() {
        return $this->idEmpleado;
    }
    public function GetDescripcion() {
        return $this->descripcion;
    }

    public function SetIdComanda($value) {
        $this->idComanda = $value;
    }
    public function SetSector($value) {
        $this->sector = $value;
    }
    public function SetIdEmpleado($value) {
        $this->idEmpleado = $value;
    }
    public function SetDescripcion($value) {
        $this->descripcion = $value;
    }
    
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
            set sector='$this->sector',
            idComanda='$this->idComanda',
            idEmpleado='$this->idEmpleado',
            descripcion='$this->descripcion'
            terminado='$this->terminado',
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public static function CargarPedidos($arrayComanda, $comanda) {
        if (in_array('barra', $arrayComanda)) {
            $pedido_nuevo = new Pedido();
            $pedido_nuevo->sector = 'barra';
            $pedido_nuevo->idPedido = $comanda;
            $pedido_nuevo->descripcion = SetDescripcion($arrayComanda['barra']);
            $pedido_nuevo->InsertarPedido();
        }
        if (in_array('cerveza', $arrayComanda)) {
            $pedido_nuevo = new Pedido();
            $pedido_nuevo->sector = 'cerveza';
            $pedido_nuevo->idPedido = $comanda;
            $pedido_nuevo->descripcion = SetDescripcion($arrayComanda['cerveza']);
            $pedido_nuevo->InsertarPedido();
        }
        if (in_array('comida', $arrayComanda)) {
            $pedido_nuevo = new Pedido();
            $pedido_nuevo->sector = 'comida';
            $pedido_nuevo->idPedido = $comanda;
            $pedido_nuevo->descripcion = SetDescripcion($arrayComanda['comida']);
            $pedido_nuevo->InsertarPedido();
        }
        if (in_array('candy', $arrayComanda)) {
            $pedido_nuevo = new Pedido();
            $pedido_nuevo->sector = 'candy';
            $pedido_nuevo->idPedido = $comanda;
            $pedido_nuevo->descripcion = SetDescripcion($arrayComanda['candy']);
            $pedido_nuevo->InsertarPedido();
        }
        return $consulta->rowCount();
    }

    public function InsertarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos
        (sector,idEmpleado,descripcion,idComanda,terminado)values
        ('$this->sector',,'$this->descripcion','$this->idComanda','false'')"
        );
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
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
    }

    public static function TraerPedido($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos where id = $id");
        $consulta->execute();
        $pedidoResultado= $consulta->fetchObject('Pedido');
        return $pedidoResultado;
    }

    public function toString() {
        return "Metodo mostar:".$this->sector."  ".$this->idEmpleado."  ".$this->descripcion;
    }
}