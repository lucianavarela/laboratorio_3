<?php
class Helado
{
	private $sabor;
	private $precio;
	private $tipo;
	private $cantidad;
	private $foto;
	
	public function GetSabor()
	{
		return $this->sabor;
	}
	public function GetPrecio()
	{
		return $this->precio;
	}
	public function GetTipo()
	{
		return $this->tipo;
	}
	public function GetCantidad()
	{
		return $this->cantidad;
	}
	public function GetFoto()
	{
		return $this->foto;
	}
	public function SetSabor($value)
	{
		$this->sabor = $value;
	}
	public function SetPrecio($value)
	{
		$this->precio = $value;
	}
	public function SetTipo($value)
	{
		$this->tipo = $value;
	}
	public function SetCantidad($value)
	{
		$this->cantidad = $value;
	}
	public function SetFoto($value)
	{
		$this->foto = $value;
	}

	public function __construct($sabor=NULL, $precio=NULL, $tipo=NULL, $cantidad=NULL, $pathFoto=NULL)
	{
		$this->sabor = $sabor;
		$this->precio = $precio;
		$this->tipo = $tipo;
		$this->pathFoto = $pathFoto;
		$this->cantidad = trim($cantidad);
	}
	
  	public function ToString()
	{
	  	return $this->sabor." - ".$this->precio." - ".$this->tipo." - ".$this->cantidad." - ".$this->pathFoto."\r\n";
    }
    
	public static function Guardar($helado)
	{
		$resultado = FALSE;
		$ar = fopen("Helados.txt", "a");
		$cant = fwrite($ar, $helado->ToString());
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		return $resultado;
    }

	public static function TraerTodosLosHelados()
	{
		$ListaDeHelados = array();
		$archivo=fopen("Helados.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$helados = explode(" - ", $archAux);
			$helados[0] = trim($helados[0]);
			if($helados[0] != ""){
				$ListaDeHelados[] = new Helado($helados[0], $helados[1], $helados[2], $helados[3], $helados[4]);
			}
		}
		fclose($archivo);
		return $ListaDeHelados;
	}

	public static function GetHelado ($sabor, $tipo) {
		$helados = Helado::TraerTodosLosHelados();
		$retorno = array();
		foreach ($helados as $helado) {
			if ($helado->sabor == $sabor && $helado->tipo == $tipo) {
				return $helado;
			}
		}
		return false;
	}

    public static function ValidarHelado ($sabor, $tipo) {
		$helados = Helado::TraerTodosLosHelados();
		$retorno = array();
		$retorno['mensaje'] = 'No existe';
		$retorno['resultado'] = false;
		foreach ($helados as $helado) {
			if ($helado->sabor == $sabor && $helado->tipo == $tipo) {
				$retorno['resultado'] = true;
				break;
			}
		}
		if (!$retorno['resultado']) {
			foreach ($helados as $helado) {
				if($helado->sabor == $sabor) {
					$retorno['mensaje'] = 'Existe el sabor';
					$retorno['resultado'] = false;
					break;
				} else if($helado->tipo == $tipo) {
					$retorno['mensaje'] = 'Existe el tipo';
					$retorno['resultado'] = false;
					break;
				}
			}
		}
		return $retorno;
	}
	
    public function Vender($cantidad, $email, $pathFoto) {
        if ($this->GetCantidad() >= $cantidad) {
			$helados = Helado::TraerTodosLosHelados();
			for($i=0; $i<count($helados); $i++){
				if ($helados[$i]->sabor == $this->sabor && $helados[$i]->tipo == $this->tipo) {
					unset($helados[$i]);
					break;
				}
			}
			$new_helado = new Helado ($this->sabor, $this->precio, $this->tipo, (($this->cantidad)-$cantidad));
			array_push($helados, $new_helado);
			$archivo = fopen("Helados.txt", "w");
			foreach($helados as $helado){
				$cant = fwrite($archivo, $helado->ToString());
				if($cant < 1)
				{
					return false;
				}
			}
			fclose($archivo);
			if (Venta::Guardar($this, $cantidad, $email, $pathFoto)) {
				return true;
			} else {
				return false;
			}
        } else {
            return false;
        }
	}

	public function Modificar($values, $imagen)
	{
		$helados = Helado::TraerTodosLosHelados();
		
		for($i=0; $i<count($helados); $i++){
			if ($helados[$i]->sabor == $values['saborActual'] && $helados[$i]->tipo == $values['tipoActual']) {
				unset($helados[$i]);
				break;
			}
		}
		$new_helado = new Helado ($values['sabor'], $values['precio'], $values['tipo'], $values['cantidad'], $imagen);
		array_push($helados, $new_helado);

		$archivo = fopen("Helados.txt", "w");
		foreach($helados as $helado){
			$cant = fwrite($archivo, $helado->ToString());
			if($cant < 1)
			{
				return false;
			}
		}
		fclose($archivo);
		return true;
	}
}