<?php
class Archivo{

	public static function Subir()
	{
		$retorno["Exito"] = TRUE;
		//INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
		$tipoArchivo = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
		$archivoTmp = $_POST["sabor"].".".date("Y-m-d-His").".jpg";
		$destino = "ImagenesDeLaVenta/" . $archivoTmp;
		

		//VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
		if ($_FILES["imagen"]["size"] > 500000) {
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "El archivo es demasiado grande. Verifique!!!";
			return $retorno;
		}

		//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
		//IMAGEN, RETORNA FALSE
		$esImagen = getimagesize($_FILES["imagen"]["tmp_name"]);

		if($esImagen === FALSE) {//NO ES UNA IMAGEN
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "S&oacute;lo son permitidas IMAGENES.";
			return $retorno;
		}
		else {// ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
			if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
				&& $tipoArchivo != "png") {
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "S&oacute;lo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.";
				return $retorno;
			}
		}
		
		if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino)) {

			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Ocurrio un error al subir el archivo. No pudo guardarse.";
			return $retorno;
		}
		else{
			$retorno["Mensaje"] = "Archivo subido exitosamente!!!"; 
			$retorno["PathTemporal"] = $archivoTmp;
			
			return $retorno;
		}
	}

	public static function Borrar($path)
	{
		return unlink($path);
	}

	public static function Mover($pathOrigen, $pathDestino)
	{
		return copy($pathOrigen, $pathDestino);
	}
}
?>