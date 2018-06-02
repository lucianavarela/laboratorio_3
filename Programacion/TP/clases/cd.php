    <?php
    class clase
    {
    public $id;
    public $param1;
    public $param2;
    public $param3;
    public function BorrarClase()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from clases 				
                WHERE id=:id");	
                $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
                $consulta->execute();
                return $consulta->rowCount();
        }

        public function ModificarClase()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update clases 
                set param1='$this->param1',
                param2='$this->param2',
                param3='$this->param3'
                WHERE id='$this->id'");
            return $consulta->execute();
        }

        public function InsertarClase()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into clases (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
                $consulta->execute();
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
                
        }
        public function ModificarClaseParametros()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update clases 
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
        
        public function InsertarClaseParametros() {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into clases (param1,param2,param3)values(:param1,:param2,:param3)");
                $consulta->bindValue(':param1',$this->param1, PDO::PARAM_INT);
                $consulta->bindValue(':param3', $this->param3, PDO::PARAM_STR);
                $consulta->bindValue(':param2', $this->param2, PDO::PARAM_STR);
                $consulta->execute();		
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public function GuardarClase() {
        if ($this->id > 0) {
            $this->ModificarClaseParametros();
        } else {
            $this->InsertarClaseParametros();
        }
    }

    public static function TraerClases() {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from clases");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS, "clase");
    }

    public static function TraerClase($id) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from clases where id = $id");
            $consulta->execute();
            $claseResultado= $consulta->fetchObject('clase');
            return $claseResultado;
    }

    public function mostrarDatos()
    {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}