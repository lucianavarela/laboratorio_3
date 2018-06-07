<?php
class Log
{
    public $id;
    public $param1;
    public $param2;
    public $param3;
    
    public function BorrarLog() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from logs
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarLog() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update logs 
            set param1='$this->param1',
            param2='$this->param2',
            param3='$this->param3'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarLog() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into logs (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function GuardarLog() {
        if ($this->id > 0) {
            $this->ModificarLog();
        } else {
            $this->InsertarLog();
        }
    }

    public static function TraerLogs() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from logs");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Log");
    }

    public static function TraerLog($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from logs where id = $id");
        $consulta->execute();
        $logResultado= $consulta->fetchObject('Log');
        return $logResultado;
    }

    public function toString() {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}