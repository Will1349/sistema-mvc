<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['nombre-reg'])) {
    require_once "../controlador/rol.controlador.php";
    $insRol = new RolControlador();


    echo $insRol->CtrInsertarRol();
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
