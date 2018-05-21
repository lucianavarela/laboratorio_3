<?php
class Venta
{
	private $email;
	private $cantidad;
	private $sabor;
	private $pathFoto;

	public function GetEmail()
	{
		return $this->email;
	}
	public function GetCantidad()
	{
		return $this->cantidad;
	}
	public function GetSabor()
	{
		return $this->sabor;
	}
	public function GetFoto()
	{
		return $this->pathFoto;
	}

	public function __construct($email=NULL, $cantidad=NULL, $sabor=NULL, $pathFoto=NULL)
	{
		$this->email = $email;
		$this->cantidad = $cantidad;
		$this->sabor = $sabor;
		$this->pathFoto = trim($pathFoto);
	}

  	public function ToString()
	{
	  	return $this->email." - ".$this->cantidad." - ".$this->sabor." - ".$this->pathFoto."\r\n";
	}

    public static function Guardar($helado, $cantidad, $email, $pathFoto)
	{
		$new_venta = new Venta ($email, $cantidad, $helado->GetSabor(), $pathFoto);
		$resultado = FALSE;
		$ar = fopen("Venta.txt", "a");
		$cant = fwrite($ar, $new_venta->ToString());
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		return $resultado;
	}

	public static function TraerTodosLasVentas()
	{
		$ListaDeVentas = array();
		$archivo=fopen("Venta.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$ventas = explode(" - ", $archAux);
			$ventas[0] = trim($ventas[0]);
			if($ventas[0] != ""){
				$ListaDeVentas[] = new Venta($ventas[0], $ventas[1], $ventas[2], $ventas[3]);
			}
		}
		fclose($archivo);
		return $ListaDeVentas;
    }

	public static function GetVentasFiltrados ($search) {
        $ventas = Venta::TraerTodosLasVentas();
        $lista_final = array();
        if (count($search) > 0) {
            foreach ($ventas as $venta) {
                if ((isset($search['email']) && $venta->email == $search['email']) || (isset($search['sabor']) && $venta->sabor == $search['sabor'])) {
                    array_push($lista_final, $venta);
                }
            }
        } else {
            $lista_final = $ventas;
        }
		return $lista_final;
    }
    
    public static function Listar ($ventas) {
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;font-weight: normal;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Ventas</h2>
            <table><tr><th>Email</th><th>Sabor</th><th>Cantidad Comprada</th><th>Imagen</th></tr>";

        foreach ($ventas as $venta) {
			$content = $content."<tr><th>".$venta->GetEmail()."</th><th>".$venta->GetSabor()."</th><th>".$venta->GetCantidad()."</th><th>";
			$imagen = "ImagenesDeLaVenta/".$venta->GetFoto();
            if(file_exists($imagen)) {
                $content = $content."<img src=\"".$imagen."\"></th></tr>";
            } else {
                $content = $content."-</th></tr>";
            }
        }
        $content = $content."</table>";
        echo $content;
	}
	
	public static function ListarImagenes ($type) {
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;font-weight: normal;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  300px;}</style><h2>Lista de Imagenes ".$type."</h2>
			<table><tr><th>Imagen</th></tr>";
		$imagenes = array();
		if ($type == 'Borradas') {
			$imagenes_array = scandir("backUpFotos");
			foreach($imagenes_array as $imagen) {
				if(strlen($imagen)>2) {
					array_push($imagenes, "backUpFotos/".$imagen);	
				}
			}
		} else {
			$imagenes_array = scandir("ImagenesDeVenta");
			foreach($imagenes_array as $imagen) {
				if(strlen($imagen)>2) {
					array_push($imagenes, "ImagenesDeVenta/".$imagen);	
				}
			}
		}
        foreach ($imagenes as $imagen) {
            if(file_exists($imagen)) {
                $content = $content."<tr><th><img src=\"".$imagen."\"></th></tr>";
            }
        }
        $content = $content."</table>";
        echo $content;
	}
}