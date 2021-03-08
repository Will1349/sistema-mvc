<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class RolModelo extends mainModel
{
    protected function MdlInsertarRol($datos)
    {
        $nombre = $datos["nombre"];
        $sql    = mainModel::conectar()->prepare("INSERT INTO rol(rol_nombre) VALUES(:nombre)");
        $sql->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sql->execute();
        return $sql;
        $sql->close();
        $sql = null;
    }
}
