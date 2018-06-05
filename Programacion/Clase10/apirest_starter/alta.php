<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Alta genérico en la aplicación</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script type="text/javascript" src="./javascript/funciones.js"></script>
	</head>	
	<body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">ALTA</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="#">Alta</a></li>
                    <li><a href="listado.php">Listado</a></li>
                    </ul>
            </div>
        </nav>    
		<div class="container">
			<form action="" method="POST" onsubmit="agregar()" role="form" style="margin:0 auto;max-width:600px;padding:15px;">
				<legend>Alta</legend>

				<div class="form-group">
					<label for="valor_char">Valor char</label>
					<input type="text" class="form-control" id="valor_char" name="valor_char" placeholder="Introduzca valor 'Char'" required >
					<label for="valor_date">Valor Fecha</label>
					<input type="date" class="form-control" id="valor_date" name="valor_date" placeholder="Introduzca valor 'Date'" required>
					<label for="valor_int">Valor Entero</label>
					<input type="number" class="form-control" id="valor_int" name="valor_int" placeholder="Introduzca valor 'Int'">
				</div>

				<input type="submit" class="btn btn-primary" value="Guardar" />
			</form>
		</div>
	</body>
</html>