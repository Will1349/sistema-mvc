<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['nombre-reg']) || isset($_POST['rolDel']) || isset($_POST['nombreRolUp'])) {
    require_once "../controlador/rol.controlador.php";
    //INSERTAR
    if (isset($_POST['nombre-reg'])) {
        require_once "../controlador/rol.controlador.php";
        $insRol = new RolControlador();
        echo $insRol->CtrInsertarRol();
    }
    //ELIMINAR
    if (isset($_POST['rolDel'])) {
        $delRol = new RolControlador();
        echo $delRol->CtrEliminarRol();
    }
    //ACTUALIZAR
    if (isset($_POST['nombreRolUp'])) {
        $upRol = new RolControlador();
        echo $upRol->ctrActualizarRol();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
