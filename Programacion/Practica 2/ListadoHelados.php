<?php
require_once ("entidades/helado.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    Helado::Listar(NULL);
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>