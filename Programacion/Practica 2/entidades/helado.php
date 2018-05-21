<?php
require_once ("entidades/IVendible.php");
class Helado implements IVendible
{
	private $sabor;
	private $precio;
	private $foto;
	
	public function GetSabor()
	{
		return $this->sabor;
	}
	public function GetPrecio()
	{
		return $this->precio;
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
	public function SetFoto($value)
	{
		$this->foto = $value;
	}

	public function __construct($sabor=NULL, $precio=NULL, $foto=NULL)
	{
		if($sabor !== NULL && $precio !== NULL && $foto !== NULL){
			$this->sabor = $sabor;
			$this->precio = $precio;
			$this->foto = trim($foto);
		}
	}
	
  	public function ToString()
	{
	  	return $this->sabor." - ".$this->precio." - ".$this->foto."\r\n";
    }
    
    public function VentaToString($cantidad)
	{
	  	return $this->sabor." - ".$cantidad." - ".($this->precio*$cantidad)."\r\n";
	}

	public static function Guardar($helado)
	{
		$resultado = FALSE;
		$ar = fopen("helados/sabores.txt", "a");
		$cant = fwrite($ar, $helado->ToString());
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		return $resultado;
    }
    
    public static function GuardarVenta($helado, $cantidad)
	{
		$resultado = FALSE;
		$ar = fopen("helados/vendidos.txt", "a");
		$cant = fwrite($ar, $helado->VentaToString($cantidad));
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
		$archivo=fopen("helados/sabores.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$helados = explode(" - ", $archAux);
			$helados[0] = trim($helados[0]);
			if($helados[0] != ""){
				$ListaDeHelados[] = new Helado($helados[0], $helados[1], $helados[2]);
			}
		}
		fclose($archivo);
		return $ListaDeHelados;
	}

	public static function ValidarHelado ($sabor) {
		$helado = Helado::GetHelado($sabor);
		if ($helado !== NULL) {
			return $helado->GetFoto();
		}
		return null;
	}
	
	public static function GetHelado ($sabor) {
		$helados = Helado::TraerTodosLosHelados();
		foreach ($helados as $helado) {
			if ($helado->sabor == $sabor) {
				return $helado;
			}
		}
		return null;
	}

    public static function SaborExistente ($sabor) {
        $helados = Helado::TraerTodosLosHelados();
		foreach ($helados as $helado) {
			if ($helado->sabor == $sabor) {
				return true;
			}
		}
		return false;
    }

	public static function Listar ($sabor) {
        if ($sabor !== NULL) {
            $helados = [Helado::GetHelado($sabor)];
        } else {
            $helados = Helado::TraerTodosLosHelados();
        }
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Helados</h2>
            <table><tr><th>Sabor</th><th>Precio</th><th>Foto</th></tr>";

        foreach ($helados as $helado) {
            $file = 'heladosImagen/'.$helado->GetFoto();
            $content = $content."<tr><th>".$helado->GetSabor()."</th><th>".$helado->GetPrecio()."</th>
            <th><img src=\"".$file."\"></th></tr>";
        }
        $content = $content."</table>";
        print($content);
    }

	public function Modificar($new_values)
	{
		$ListaDeHelados = Helado::TraerTodosLosHelados();
		
		for($i=0; $i<count($ListaDeHelados); $i++){
			if($ListaDeHelados[$i]->GetSabor() == $new_values["sabor"]) {
				unset($ListaDeHelados[$i]);
				break;
			}
		}
		$new_helado = new Helado ($new_values['sabor'], $new_values['precio'], $new_values['foto']);
		array_push($ListaDeHelados, $new_helado);

		$archivo = fopen("helados/sabores.txt", "w");
		foreach($ListaDeHelados as $helado){
			$cant = fwrite($archivo, $helado->ToString());
			if($cant < 1)
			{
				return false;
			}
		}
		fclose($archivo);
		return true;
    }
    
    public function Eliminar()
	{
		$ListaDeHelados = Helado::TraerTodosLosHelados();
		
		for($i=0; $i<count($ListaDeHelados); $i++){
			if($ListaDeHelados[$i]->GetSabor() == $this->GetSabor()) {
				unset($ListaDeHelados[$i]);
				break;
			}
		}
		//Si existe, muevo la imagen a la carpeta de back up.
		if(file_exists("heladosImagen/".$this->GetFoto())) {
			rename ("heladosImagen/".$this->GetFoto(),"heladosBorrados/".$this->GetSabor().".borrado.".date("His").".jpg");
		}

		$archivo = fopen("helados/sabores.txt", "w");
		foreach($ListaDeHelados as $user){
			$cant = fwrite($archivo, $user->ToString());
			if($cant < 1)
			{
				return false;
			}
		}
		fclose($archivo);
		return true;
    }
    
    public function PrecioMasIva() {
        return $this->GetPrecio() * 1.21;
    }

    public function Vender($cantidad) {
        if (Helado::GuardarVenta($this, $cantidad)) {
            return $this->GetPrecio() * $cantidad;
        } else {
            return NULL;
        }
    }
}