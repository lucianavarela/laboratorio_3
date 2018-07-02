<?php
class Usuario
{
    public $id;
    public $nombre;
    public $clave;
    public $nivel;
    
    public function GetNombre() {
        return $this->nombre;
    }
    public function GetClave() {
        return $this->clave;
    }
    public function GetNivel() {
        return $this->nivel;
    }

    public function SetNombre($value) {
        $this->nombre = $value;
    }
    public function SetClave($value) {
        $this->clave = $value;
    }
    public function SetNivel($value) {
        $this->nivel = $value;
    }
    
    public function BorrarUsuario() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from usuarios
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarUsuario() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update usuarios 
            set nombre='$this->nombre',
            clave='$this->clave',
            nivel='$this->nivel'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarUsuario() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,clave,nivel)values('$this->nombre','$this->clave','$this->nivel')");
        $consulta->execute();
        return $nuevoNombre;
    }

    public function GuardarUsuario() {
        if ($this->id > 0) {
            $this->ModificarUsuario();
        } else {
            $this->InsertarUsuario();
        }
    }

    public static function TraerUsuarios() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios;");
        $consulta->execute();
        $usuario = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
        return $usuario;
    }

    public static function TraerUsuario($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where id = '$id'");
        $consulta->execute();
        $usuariosResultado= $consulta->fetchObject('Usuario');
        return $usuariosResultado;
    }

    public static function ValidarUsuario($nombre, $clave) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where nombre = '$nombre' and clave = '$clave'");
        $consulta->execute();
        $usuariosResultado= $consulta->fetchObject('Usuario');
        return $usuariosResultado;
    }

    public function toString() {
        return "\nUsuario #$this->id -> ".$this->GetClave();
    }
}