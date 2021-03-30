<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class UsuarioModelo extends mainModel
{
    // Insertar
    protected function MdlInsertarUsuario($datos)
    {
        $usuario = $datos["usuario"];
        $password = $datos["password"];
        $rolid = $datos['rol'];


        $sql    = mainModel::conectar()->prepare("INSERT INTO usuario(usu_usuario, usu_password,rol_id) VALUES(:nombre, :password, :rol_id)");
        // $sql->bindValue(":usuario",  $datos["usuario"]);
        // $sql->bindValue(":password", $datos["password"]);
        // $sql->bindValue(":rol_id", "%{$rolid    }%" );
        $sql->execute(array(':nombre' => $usuario, ':password' => $password, ':rol_id' => $rolid));
        return $sql;
        $sql->close();
        $sql = null;
    }

    // Consultar
    protected function MdlMostrarUsuarios()
    {
        $sql  = mainModel::conectar()->prepare("SELECT * FROM usuario as u INNER JOIN rol as r ON u.rol_id = r.rol_id");
        $sql->execute();
        return $sql;
        $sql->close();
        $sql = null;
    }

    // Actualizar
    protected function MdlActualzarUsuario($datos)
    {
        $id = $datos["id"];
        $usuario = $datos["usuario"];
        $password = $datos["password"];
        $rolid = $datos['rol'];
        $sql = mainModel::conectar()->prepare("UPDATE usuario SET usu_usuario = :usuario , usu_password = :password ,rol_id = :rol WHERE usu_id = :id");

        // $sql->bindParam(":id" , $datos["id"]);
        // $sql->bindParam(":usuario", $datos["usuario"]);
        // $sql->bindParam(":password", $datos["password"]);
        $sql->execute(array(
            ':usuario' => $usuario, 
            ':password' => $password, 
            ':rol' => $rolid, 
            ':id' => $id));

        return $sql;

        $sql->close();
        $sql = null;
    }

    protected function MdlEliminarUsuario($dato)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE usu_id =:id ");
        // $sql->bindParam(":id", $dato);
        $sql->execute(array(":id" =>$dato));
        return $sql;
        $sql->close();
        $sql = null;
    }
}
