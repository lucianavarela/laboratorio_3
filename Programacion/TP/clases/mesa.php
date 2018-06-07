<?php
class Mesa
{
    public $id;
    public $param1;
    public $param2;
    public $param3;
    
    public function BorrarMesa() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from mesas
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarMesa() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update mesas 
            set param1='$this->param1',
            param2='$this->param2',
            param3='$this->param3'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarMesa() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mesas (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarMesa() {
        if ($this->id > 0) {
            $this->ModificarMesa();
        } else {
            $this->InsertarMesa();
        }
    }

    public static function TraerMesas() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from mesas");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Mesa");
    }

    public static function TraerMesa($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from mesas where id = $id");
        $consulta->execute();
        $mesaResultado= $consulta->fetchObject('Mesa');
        return $mesaResultado;
    }

    public function toString() {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}