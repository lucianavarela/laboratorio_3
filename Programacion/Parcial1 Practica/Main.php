<?php
require_once ("Entidades/alumno.php");
require_once ("Entidades/archivo.php");
$request = isset($_POST['request']) ? $_POST['request'] : NULL;

if ($request) {
	switch($request){
		case "Subir":

			$respuestaDeSubir = Archivo::Subir();

			if(!$respuestaDeSubir["Exito"]){
				echo "error " .$respuestaDeSubir["Mensaje"];
				break;
			}
			$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
			$archivo = $respuestaDeSubir["PathTemporal"];
			$alumno_nuevo = new Alumno($legajo, $nombre, $archivo);
			
			if(!Alumno::Guardar($alumno_nuevo)){
				echo "Error al generar archivo";
			} else {
				echo $_POST["nombre"]." ha sido creado/a.";
			}
			break;
			
		case "Eliminar":
			$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
		
			if(!Alumno::Eliminar($legajo)){
				echo "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
			} else {
				echo $_POST["nombre"]." ha sido eliminado/a.";
			}
			break;
		
		case "Modificar":
			$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
			if(!Alumno::Modificar($legajo)){
				echo "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
			} else {
				echo $_POST["nombre"]." ha sido eliminado/a.";
			}
			break;

		default:
			echo "No se ha reconocido su request.";
	}
} else {
	$request = isset($_GET['request']) ? $_GET['request'] : NULL;
	if ($request) {
		if ($request == "Listar") {
			Alumno::Listar();
		} else {
			print("No se ha reconocido su request.");
		}
	} else {
		print("No se ha reconocido su request.");
	}
}
?>