<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['nombre-reg']) || $_POST['rolDel']) {
    require_once "../controlador/rol.controlador.php";

    // Insertar 
    if (isset($_POST['nombre-reg'])) {

        $insRol = new RolControlador();
        echo $insRol->CtrInsertarRol();
    }

    // Eliminar
    if (isset($_POST['rolDel'])) {
        $delRol = new RolControlador();
        echo $delRol->CtrEliminarRol();
    }


    // } 
    // elseif (isset($_POST['rolDel'])) {

} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login/"</script>';
}
