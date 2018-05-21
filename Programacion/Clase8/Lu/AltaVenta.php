<?php
require_once ("Entidades/venta.php");
require_once ("Entidades/helado.php");
require_once ("Entidades/cliente.php");
require_once ("Entidades/empleado.php");
require_once ("Entidades/local.php");
require_once ("Entidades/AccesoDatos.php");
// Recibe el id del local, id del cliente, el id del empleado, el id de helado, la fecha,
// cantidad, si el helado existe y hay stock guardar la venta en la base
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idL']) && isset($_POST['idC']) && isset($_POST['idE']) && isset($_POST['idH']) && isset($_POST['cantidad'])) {
        $helado = Helado::ValidarId($_POST['idH'])
        if($helado && Cliente::ValidarId($_POST['idC']) && Empleado::ValidarId($_POST['idE']) && Local::ValidarId($_POST['idL'])) {
            if ($helado->GetCantidad()<$_POST['cantidad']) {
                $venta_nueva = Venta::Nuevo($_POST['idL'],$_POST['idC'],$_POST['idE'],$_POST['idH'],$_POST['cantidad']));
            } else {
                echo "ERROR, no hay stock suficiente";
            }
            if ($venta_nueva != NULL) {
                echo "Listo! Se cargo la venta N°".$venta_nueva->Guardar();
            } else {
                echo "ERROR en carga";
            }
        } else {
            echo 'ERROR, id incorrecto';
        }
    } else {
        echo"ERROR en valores";
    }
}
?>