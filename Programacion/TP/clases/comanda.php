<?php
class Comanda
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
        $estados = array("pendiente", "en preparación", "listo para servir", "cerrado", "cancelado");
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
    
    public function InsertarComanda() {
        $nuevoCodigo = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 5);
        if ($this->foto !== NULL) {
            $this->foto = $nuevoCodigo.'.'.$this->foto;
        }
        $mesa = Mesa::TraerMesa($this->idMesa);
        if ($mesa && $mesa->GetEstado() == 'Cerrada') {
            $mesa->SetEstado('con cliente esperando pedido');
            $mesa->GuardarMesa();
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into comandas (nombreCliente,codigo,estado,idMesa,foto)
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

    public function ModificarComanda() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update comandas 
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

    public function GuardarComanda() {
        if ($this->id > 0) {
            $this->ModificarComanda();
        } else {
            $codigo = $this->InsertarComanda();
            return $codigo;
        }
    }

    public function BorrarComanda() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from comandas
            WHERE id=$this->id;");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function TraerComandas() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from comandas;");
        $consulta->execute();
        $comandas = $consulta->fetchAll(PDO::FETCH_CLASS, "Comanda");
        foreach($comandas as $comanda) {
            echo $comanda->toString();
        }
        return $comandas;
    }

    public static function TraerComanda($codigoComanda, $codigoMesa) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from comandas where codigo = '$codigoComanda' and idMesa = '$codigoMesa';");
        $consulta->execute();
        $comandaResultado= $consulta->fetchObject('Comanda');
        if ($comandaResultado) {
            $pedidos = Pedido::TraerPedidosPorComanda($codigoComanda);
            foreach($pedidos as $pedido) {

            }
            echo "Estado de su pedido: ".($comandaResultado->GetEstado());
        } else {
            echo "Comanda incorrecto";
        }
        return $comandaResultado;
    }

    public function toString() {
        return "\nComanda #$this->codigo: $this->nombreCliente (Mesa #$this->idMesa) -> ".$this->GetEstado();
    }
}