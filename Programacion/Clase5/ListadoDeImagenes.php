<?php
    function Listar () {
        $alumnos = Alumno::TraerTodosLosAlumnos();
        $content = "<style>table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;padding: 8px;}
            tr:nth-child(even) {background-color: #dddddd;} img {max-height:  100px;}</style><h2>Lista de Alumnos</h2>
            <table><tr><th>Legajo</th><th>Nombre</th><th>Foto</th></tr>";

        foreach ($alumnos as $alumno) {
            $file = 'archivos/'.$alumno->GetPathFoto();
            $content = $content."<tr><th>".$alumno->GetLegajo()."</th><th>".$alumno->GetNombre()."</th>
            <th><img src=\"".$file."\"></th></tr>";
        }
        $content = $content."</table>";
        print($content);
    }
?>