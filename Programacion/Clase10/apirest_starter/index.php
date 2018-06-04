<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ApiRest con Slim Framework</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">        
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script type="text/javascript" src="./javascript/funciones.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">ApiRest</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a onclick="apirest_get()" style="cursor:pointer" >GET</a></li>
                    <li><a onclick="apirest_post()" style="cursor:pointer" >POST</a></li>
                    <li><a onclick="apirest_put()" style="cursor:pointer" >PUT</a></li>
                    <li><a onclick="apirest_delete()" style="cursor:pointer" >DELETE</a></li>
                    <li><a onclick="apirest_get_uno(2)" style="cursor:pointer" >GET UNO</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div id="divTabla"></div>
        </div>
    </body>
</html>