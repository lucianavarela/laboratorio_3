    <?php
    class socio
    {
    public $id;
    public $param1;
    public $param2;
    public $param3;
    public function BorrarSocio()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from socios 				
                WHERE id=:id");	
                $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
                $consulta->execute();
                return $consulta->rowCount();
        }

        public function ModificarSocio()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update socios 
                set param1='$this->param1',
                param2='$this->param2',
                param3='$this->param3'
                WHERE id='$this->id'");
            return $consulta->execute();
        }

        public function InsertarSocio()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into socios (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
                $consulta->execute();
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
                
        }
        public function ModificarSocioParametros()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update socios 
                set param1=:param1,
                param2=:param2,
                param3=:param3
                WHERE id=:id");
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
            $consulta->bindValue(':param1',$this->param1, PDO::PARAM_INT);
            $consulta->bindValue(':param3', $this->param3, PDO::PARAM_STR);
            $consulta->bindValue(':param2', $this->param2, PDO::PARAM_STR);
            return $consulta->execute();
        }
        
        public function InsertarSocioParametros() {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into socios (param1,param2,param3)values(:param1,:param2,:param3)");
                $consulta->bindValue(':param1',$this->param1, PDO::PARAM_INT);
                $consulta->bindValue(':param3', $this->param3, PDO::PARAM_STR);
                $consulta->bindValue(':param2', $this->param2, PDO::PARAM_STR);
                $consulta->execute();		
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public function GuardarSocio() {
        if ($this->id > 0) {
            $this->ModificarSocioParametros();
        } else {
            $this->InsertarSocioParametros();
        }
    }

    public static function TraerSocios() {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from socios");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS, "socio");
    }

    public static function TraerSocio($id) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from socios where id = $id");
            $consulta->execute();
            $socioResultado= $consulta->fetchObject('socio');
            return $socioResultado;
    }

    public function mostrarDatos()
    {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}