<?php 

if ($peticionAjax) {
    require_once '../core/mainModel.php';
} else {
    require_once './core/mainModel.php';
}

class RolModelo extends mainModel
{
	//Insertar Rol
	protected function MdlInsertarRol($datos)
	{
		$sql = mainModel::conectar()->prepare("INSERT INTO rol(rol_nombre) VALUES (:nombre)");
		$sql->bindParam(":nombre",$datos['nombre'], PDO::PARAM_STR);
		$sql->execute();
		return $sql;
		$sql->close();
		$sql = null;

	}
}