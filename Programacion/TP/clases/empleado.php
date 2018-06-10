<?php
class Empleado
{
    protected $id;
    protected $email;
    protected $clave;
    protected $sector;
    protected $estado;
    
    public function GetEmail() {
        return $this->email;
    }
    public function GetClave() {
        return $this->clave;
    }
    public function GetSector() {
        return $this->sector;
    }
    public function GetEstado() {
        return $this->estado;
    }

    public function SetEmail($value) {
        $this->email = $value;
    }
    public function SetClave($value) {
        $this->clave = $value;
    }
    public function SetSector($value) {
        $this->sector = $value;
    }
    public function SetEstado($value) {
        $estados = array("activo", "suspendido", "inactivo");
        if (in_array($value, $estados)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function BorrarEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from empleados
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update empleados 
            set email='$this->email',
            clave='$this->clave',
            sector='$this->sector'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarEmpleado() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (email,clave,sector)values('$this->email','$this->clave','$this->sector')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarEmpleado() {
        if ($this->id > 0) {
            $this->ModificarEmpleado();
        } else {
            $this->InsertarEmpleado();
        }
    }

    public static function TraerEmpleados() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,email as email, clave as clave,sector as sector from empleados");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");
    }

    public static function TraerEmpleado($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id, email as email, clave as clave,sector as sector from empleados where id = $id");
        $consulta->execute();
        $empleadoResultado= $consulta->fetchObject('Empleado');
        return $empleadoResultado;
    }

    public static function TomarPedido($id, $pedido, $tiempo) {
        $empleado = Empleado::TraerEmpleado($id);
        $pedido = Pedido::TraerPedido($pedido);
        $pedido->SetIdEmpleado($empleado->id);
        $pedido->GuardarPedido();
        return "Se le ha asignado el pedido para la comanda #".$pedido->GetIdComanda().
        "\nDetalles del pedido: ".$pedido->GetDescripcion();
    }

    public function toString() {
        return "Metodo mostar:".$this->email."  ".$this->clave."  ".$this->sector;
    }
}