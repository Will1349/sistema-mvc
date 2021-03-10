<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['nombre-reg']) || isset($_POST['rolDel'])) {
    require_once "../controlador/rol.controlador.php";
    //INSERTAR
    if (isset($_POST['nombre-reg'])) {
        require_once "../controlador/rol.controlador.php";
        $insRol = new RolControlador();
        echo $insRol->CtrInsertarRol();
    }
    if (isset($_POST['rolDel'])) {
        $delRol = new RolControlador();
        echo $delRol->CtrEliminarRol();
    }
}
//ELIMINAR
 else {
     session_start();
     session_destroy();
     echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
 }
