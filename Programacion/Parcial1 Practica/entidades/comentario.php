<?php
class Comentario
{
	private $email;
	private $titulo;
	private $comentario;

	public function GetEmail()
	{
		return $this->email;
	}
	public function GetTitulo()
	{
		return $this->titulo;
	}
	public function GetComentario()
	{
		return $this->comentario;
	}

	public function __construct($email=NULL, $titulo=NULL, $comentario=NULL)
	{
		if($email !== NULL && $titulo !== NULL && $comentario !== NULL){
			$this->email = $email;
			$this->titulo = $titulo;
			$this->comentario = trim($comentario);
		}
	}

  	public function ToString()
	{
	  	return $this->email." - ".$this->titulo." - ".$this->comentario."\r\n";
	}

    public static function TituloExistente ($titulo) {
        $comentarios = Comentario::TraerTodosLosComentarios();
		foreach ($comentarios as $comentario) {
			if ($comentario->titulo == $titulo) {
				return true;
			}
		}
		return false;
    }

	public static function Guardar($obj)
	{
		$resultado = FALSE;
		$ar = fopen("archivos/Comentario.txt", "a");
		$cant = fwrite($ar, $obj->ToString());
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		return $resultado;
	}

	public function Eliminar()
	{
		$ListaDeComentarios = Comentario::TraerTodosLosComentarios();
		
		for($i=0; $i<count($ListaDeComentarios); $i++){
			if($ListaDeComentarios[$i]->GetTitulo() == $this->GetTitulo()) {
				unset($ListaDeComentarios[$i]);
				break;
			}
		}
		//Si existe, muevo la imagen a la carpeta de back up.
		if(file_exists("ImagenesDeComentario/".$this->GetTitulo().".jpg")) {
			rename ("ImagenesDeComentario/".$this->GetTitulo().".jpg","backUpFotos/".$this->GetTitulo()."(".date("Y-m-d").").jpg");
		}

		$archivo = fopen("archivos/Comentario.txt", "w");
		foreach($ListaDeComentarios as $user){
			$cant = fwrite($archivo, $user->ToString());
			if($cant < 1)
			{
				return false;
			}
		}
		fclose($archivo);
		return true;
	}

	public static function TraerTodosLosComentarios()
	{
		$ListaDeComentarios = array();
		$archivo=fopen("archivos/Comentario.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$comentarios = explode(" - ", $archAux);
			$comentarios[0] = trim($comentarios[0]);
			if($comentarios[0] != ""){
				$ListaDeComentarios[] = new Comentario($comentarios[0], $comentarios[1], $comentarios[2]);
			}
		}
		fclose($archivo);
		return $ListaDeComentarios;
    }
    
	public static function GetComment ($titulo) {
		$comentarios = Comentario::TraerTodosLosComentarios();
		foreach ($comentarios as $comentario) {
			if ($comentario->GetTitulo() == $titulo) {
				return $comentario;
			}
		}
		return null;
	}

	public static function GetComentariosFiltrados ($search) {
        $comentarios = Comentario::TraerTodosLosComentarios();
        $lista_final = array();
        if (count($search) > 0) {
            foreach ($comentarios as $comentario) {
                if ((isset($search['email']) && $comentario->email == $search['email']) || (isset($search['titulo']) && $comentario->titulo == $search['titulo']) || (isset($search['comentario']) && $comentario->comentario == $search['comentario'])) {
                    array_push($lista_final, $comentario);
                }
            }
        } else {
            $lista_final = $comentarios;
        }
		return $lista_final;
    }
    
    public static function Listar ($comentarios) {
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;font-weight: normal;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Comentarios</h2>
            <table><tr><th>Usuario</th><th>Edad</th><th>Titulo</th><th>Comentario</th><th>Imagen</th></tr>";

        foreach ($comentarios as $comentario) {
			$usuario = Usuario::GetUsuario($comentario->GetEmail());
			$content = $content."<tr><th>".$usuario->GetNombre()."</th><th>".$usuario->GetEdad()."</th><th>".$comentario->GetTitulo()."</th><th>".$comentario->GetComentario()."</th><th>";
			$imagen = "ImagenesDeComentario/".$comentario->GetTitulo().".jpg";
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
			$imagenes_array = scandir("ImagenesDeComentario");
			foreach($imagenes_array as $imagen) {
				if(strlen($imagen)>2) {
					array_push($imagenes, "ImagenesDeComentario/".$imagen);	
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