<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ABM Genérico con ApiRest</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="./javascript/funciones.js"></script>
        <script type="text/javascript">
            window.onload = function(){
                traerTodos();
            }
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Listado</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="alta.php">Alta</a></li>
                    <li class="active"><a href="listado.php">Listado</a></li>
                    </ul>
            </div>
        </nav>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modificación</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" role="form" style="margin:0 auto;max-width:600px;padding:15px;">

                            <div class="form-group">
                                <label for="id">Id</label>
                                <input type="text" class="form-control" id="id" name="id" readonly>
                                <label for="valor_char">Valor char</label>
                                <input type="text" class="form-control" id="valor_char" name="valor_char" >
                                <label for="valor_date">Valor Fecha</label>
                                <input type="date" class="form-control" id="valor_date" name="valor_date" >
                                <label for="valor_int">Valor Entero</label>
                                <input type="number" class="form-control" id="valor_int" name="valor_int" >
                            </div>

                            <div id="divMensaje" class="form-group" style="display:none;height:20px;">
                                <h3><span id="spanMensaje" class="label label-danger"></span></h3>
                            </div>
                            
                            <button type="button" id="btnModificar" class="btn btn-primary" onclick="modificar()" >Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" >
            <div id="divTabla"></div>
        </div>
    </body>
</html>