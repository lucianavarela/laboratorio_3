<?php
class Socio
{
    public $id;
    public $param1;
    public $param2;
    public $param3;
    
    public function BorrarSocio() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from socios
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarSocio() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update socios 
            set param1='$this->param1',
            param2='$this->param2',
            param3='$this->param3'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarSocio() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into socios (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarSocio() {
        if ($this->id > 0) {
            $this->ModificarSocio();
        } else {
            $this->InsertarSocio();
        }
    }

    public static function TraerSocios() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from socios");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Socio");
    }

    public static function TraerSocio($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from socios where id = $id");
        $consulta->execute();
        $socioResultado= $consulta->fetchObject('Socio');
        return $socioResultado;
    }

    public function toString() {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}