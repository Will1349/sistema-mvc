<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class RolModelo extends mainModel
{
    // Insertar
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

    // Consultar
    protected function MdlMostrarRoles()
    {
        $sql  = mainModel::conectar()->prepare("SELECT * FROM rol");
        $sql->execute();
        return $sql;
        $sql->close();
        $sql = null;
    }

    // Eliminar
    protected function MdlEliminarROl($dato)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM rol WHERE rol_id =:id ");
        $sql->bindParam(":id", $dato);
        $sql->execute();
        return $sql;
        $sql->close();
        $sql = null;
    }
}
