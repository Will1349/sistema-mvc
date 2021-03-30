<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if ((isset($_POST['usuNew']) && isset($_POST['pass1New'])) || (isset($_POST['usuUp']) && isset($_POST['pass1Up'])) || (isset($_POST['usuDel']))) {
    require_once "../controlador/usuario.controlador.php";

    // Insertar 
    if (isset($_POST['usuNew']) && isset($_POST['pass1New'])) {

        $insUsuario = new UsuarioControlador();
        echo $insUsuario->CtrInsertarUsuario();
    }
    if (isset($_POST['usuUp']) && isset($_POST['pass1Up'])) {
        $upUsu = new UsuarioControlador();
        echo $upUsu->CtrActualizarUsuario();
    }

    // Eliminar
    if (isset($_POST['usuDel'])) {
        $delRol = new UsuarioControlador();
        echo $delRol->CtrEliminarUsuario();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login/"</script>';
}
