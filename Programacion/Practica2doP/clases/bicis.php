<?php
class Bici
{
    public $id;
    public $marca;
    public $precio;
    public $foto;
    
    public function GetMarca() {
        return $this->marca;
    }
    public function GetPrecio() {
        return $this->precio;
    }
    public function GetFoto() {
        return $this->foto;
    }

    public function SetMarca($value) {
        $this->marca = $value;
    }
    public function SetPrecio($value) {
        $this->precio = $value;
    }
    public function SetFoto($value) {
        $this->foto = $value;
    }
    
    public function BorrarBici() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from bicis
            WHERE id=$this->id");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function ModificarBici() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update bicis 
            set marca='$this->marca',
            precio='$this->precio',
            foto='$this->foto'
            WHERE id=$this->id");
        return $consulta->execute();
    }

    public function InsertarBici() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into bicis (marca,precio,foto)values('$this->marca','$this->precio','$this->foto')");
        $consulta->execute();
        return $nuevoMarca;
    }

    public function GuardarBici() {
        if ($this->id > 0) {
            $this->ModificarBici();
        } else {
            $this->InsertarBici();
        }
    }

    public static function TraerBicis() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from bicis;");
        $consulta->execute();
        $bicis = $consulta->fetchAll(PDO::FETCH_CLASS, "Bici");
        return $bicis;
    }

    public static function TraerBici($id) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from bicis where id = '$id'");
        $consulta->execute();
        $biciResultado= $consulta->fetchObject('Bici');
        return $biciResultado;
    }

    public function toString() {
        return "\nBici #$this->id -> ".$this->GetPrecio();
    }
}