<?php
class Pedido
{
    private $id;
    private $nombreCliente;
    private $codigo;
    private $estado;
    private $importe;
    private $idMesa;
    private $foto;
    private $fechaIngresado;
    private $fechaEstimado;
    private $fechaEntregado;
    
    public function GetNombreCliente() {
        return $this->nombreCliente;
    }
    public function GetCodigo() {
        return $this->codigo;
    }
    public function GetEstado() {
        return $this->estado;
    }
    public function GetImporte() {
        return $this->importe;
    }
    public function GetIdMesa() {
        return $this->idMesa;
    }
    public function GetFoto() {
        return $this->foto;
    }
    public function GetFechaIngresado() {
        return $this->fechaIngresado;
    }
    public function GetFechaEstimado() {
        return $this->fechaEstimado;
    }
    public function GetFechaEntregado() {
        return $this->fechaEntregado;
    }

    public function SetNombreCliente($value) {
        $this->nombreCliente = $value;
    }
    public function SetCodigo($value) {
        if (strlen($value) == 5) {
            $this->codigo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function SetEstado($value) {
        $estados = array("nuevo", "en preparación", "listo para servir", "cerrado", "cancelado");
        if (in_array($value, $estados)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function SetImporte($value) {
        if (is_float($value)) {
            $this->importe = (float)$value;
            return true;
        } else {
            return false;
        }
    }
    public function SetIdMesa($value) {
        if (is_int($value)) {
            $this->idMesa = (int)$value;
            return true;
        } else {
            return false;
        }
    }
    public function SetFoto($value) {
        $this->foto = $value;
    }
    public function SetFechaIngresado($value) {
        $this->fechaIngresado = $value;
    }
    public function SetFechaEstimado($value) {
        $this->fechaEstimado = $value;
    }
    public function SetFechaEntregado($value) {
        $this->fechaEntregado = $value;
    }

    public function InsertarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (nombreCliente,codigo,estado,importe,idMesa,foto,fechaIngresado,fechaEstimado,fechaEntregado)
            values(
            '$this->nombreCliente',
            '$this->codigo',
            '$this->estado',
            '$this->importe',
            $this->idMesa,
            '$this->foto',
            '$this->fechaIngresado',
            '$this->fechaEstimado',
            '$this->fechaEntregado'
            );");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function ModificarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update pedidos 
            set nombreCliente='$this->nombreCliente',
            codigo='$this->codigo',
            estado='$this->estado',
            importe='$this->importe',
            idMesa=$this->idMesa,
            foto='$this->foto',
            fechaIngresado='$this->fechaIngresado',
            fechaEstimado='$this->fechaEstimado',
            fechaEntregado='$this->fechaEntregado'
            WHERE id=$this->id;");
        return $consulta->execute();
    }

    public function GuardarPedido() {
        if ($this->id > 0) {
            $this->ModificarPedido();
        } else {
            $this->InsertarPedido();
        }
    }

    public function BorrarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from pedidos
            WHERE id=$this->id;");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function TraerPedidos() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
    }

    public static function TraerPedido($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos where id = $id;");
        $consulta->execute();
        $pedidoResultado= $consulta->fetchObject('Pedido');
        return $pedidoResultado;
    }

    public function toString() {
        return "Pedido #$this->codigo: $this->nombreCliente (Mesa $this->estado)";
    }
}