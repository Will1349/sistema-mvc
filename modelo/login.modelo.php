<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class LoginModelo extends mainModel
{
    protected function MdlIniciarSession($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usu_usuario = :usuario AND usu_password = :password");
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":password", $datos['password']);
        $sql->execute();
        return $sql;

        $sql->close();
        $sql = null;
    }
}
