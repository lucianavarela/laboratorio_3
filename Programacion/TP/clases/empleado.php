    <?php
    class empleado
    {
    public $id;
    public $param1;
    public $param2;
    public $param3;
    public function BorrarEmpleado()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from empleados 				
                WHERE id=:id");	
                $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
                $consulta->execute();
                return $consulta->rowCount();
        }

        public function ModificarEmpleado()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update empleados 
                set param1='$this->param1',
                param2='$this->param2',
                param3='$this->param3'
                WHERE id='$this->id'");
            return $consulta->execute();
        }

        public function InsertarEmpleado()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
                $consulta->execute();
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
                
        }
        public function ModificarEmpleadoParametros()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update empleados 
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
        
        public function InsertarEmpleadoParametros() {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (param1,param2,param3)values(:param1,:param2,:param3)");
                $consulta->bindValue(':param1',$this->param1, PDO::PARAM_INT);
                $consulta->bindValue(':param3', $this->param3, PDO::PARAM_STR);
                $consulta->bindValue(':param2', $this->param2, PDO::PARAM_STR);
                $consulta->execute();		
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public function GuardarEmpleado() {
        if ($this->id > 0) {
            $this->ModificarEmpleadoParametros();
        } else {
            $this->InsertarEmpleadoParametros();
        }
    }

    public static function TraerEmpleados() {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from empleados");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");
    }

    public static function TraerEmpleado($id) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from empleados where id = $id");
            $consulta->execute();
            $empleadoResultado= $consulta->fetchObject('empleado');
            return $empleadoResultado;
    }

    public function mostrarDatos()
    {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}