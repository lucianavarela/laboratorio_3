<?php
class Pedido
{
    protected $id;
    protected $nombreCliente;
    protected $codigo;
    protected $estado;
    protected $importe;
    protected $idMesa;
    protected $foto;
    protected $fechaIngresado;
    protected $fechaEstimado;
    protected $fechaEntregado;
    
    public function GetNombreCliente() {
        return $this->nombreCliente;
    }
    public function GetCodigo() {
        return $this->codigo;
    }
    public function GetEstado() {
        return ucwords($this->estado);
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
        if (is_numeric($value)) {
            $this->importe = (float)$value;
            return true;
        } else {
            return false;
        }
    }
    public function SetIdMesa($value) {
        $this->idMesa = $value;
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

    public function __construct(){}
    
    public function InsertarPedido() {
        $nuevoCodigo = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 5);
        if ($this->foto !== NULL) {
            $this->foto = $nuevoCodigo.'.'.$this->foto;
        }
        $mesa = Mesa::TraerMesa($this->idMesa);
        if ($mesa && $mesa->GetEstado() == 'Cerrada') {
            $mesa->SetEstado('con cliente esperando pedido');
            $mesa->GuardarMesa();
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (nombreCliente,codigo,estado,idMesa,foto)
                values(
                '$this->nombreCliente',
                '$nuevoCodigo',
                '$this->estado',
                '$this->idMesa',
                '$this->foto'
                );");
            $consulta->execute();
            return $nuevoCodigo;
        } else {
            return NULL;
        }
    }

    public function ModificarPedido() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update pedidos 
            set nombreCliente='$this->nombreCliente',
            codigo='$this->codigo',
            estado='$this->estado',
            importe='$this->importe',
            idMesa='$this->idMesa',
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
            $codigo = $this->InsertarPedido();
            return $codigo;
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
        $pedidos = $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
        foreach($pedidos as $pedido) {
            echo $pedido->toString();
        }
        return $pedidos;
    }

    public static function TraerPedido($codigoPedido, $codigoMesa) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos where codigo = '$codigoPedido' and idMesa = '$codigoMesa';");
        $consulta->execute();
        $pedidoResultado= $consulta->fetchObject('Pedido');
        if ($pedidoResultado) {
            echo "Estado de su pedido: ".($pedidoResultado->GetEstado());
        } else {
            echo "Pedido incorrecto";
        }
        return $pedidoResultado;
    }

    public function toString() {
        return "\nPedido #$this->codigo: $this->nombreCliente (Mesa #$this->idMesa) -> ".$this->GetEstado();
    }
}