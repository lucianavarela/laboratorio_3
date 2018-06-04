    <?php
    class pedido
    {
    public $id;
    public $param1;
    public $param2;
    public $param3;
    public function BorrarPedido()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                delete 
                from pedidos 				
                WHERE id=:id");	
                $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
                $consulta->execute();
                return $consulta->rowCount();
        }

        public function ModificarPedido()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update pedidos 
                set param1='$this->param1',
                param2='$this->param2',
                param3='$this->param3'
                WHERE id='$this->id'");
            return $consulta->execute();
        }

        public function InsertarPedido()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (param1,param2,param3)values('$this->param1','$this->param2','$this->param3')");
                $consulta->execute();
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
                
        }
        public function ModificarPedidoParametros()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                update pedidos 
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
        
        public function InsertarPedidoParametros() {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (param1,param2,param3)values(:param1,:param2,:param3)");
                $consulta->bindValue(':param1',$this->param1, PDO::PARAM_INT);
                $consulta->bindValue(':param3', $this->param3, PDO::PARAM_STR);
                $consulta->bindValue(':param2', $this->param2, PDO::PARAM_STR);
                $consulta->execute();		
                return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public function GuardarPedido() {
        if ($this->id > 0) {
            $this->ModificarPedidoParametros();
        } else {
            $this->InsertarPedidoParametros();
        }
    }

    public static function TraerPedidos() {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id,param1 as param1, param2 as param2,param3 as param3 from pedidos");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS, "pedido");
    }

    public static function TraerPedido($id) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("select id, param1 as param1, param2 as param2,param3 as param3 from pedidos where id = $id");
            $consulta->execute();
            $pedidoResultado= $consulta->fetchObject('pedido');
            return $pedidoResultado;
    }

    public function mostrarDatos()
    {
        return "Metodo mostar:".$this->param1."  ".$this->param2."  ".$this->param3;
    }
}