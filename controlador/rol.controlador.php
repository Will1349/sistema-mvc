<?php 
if ($peticionAjax) {
    require_once '../modelo/rol.modelo.php';
} else {
    require_once './modelo/rol.modelo.php';
}

class RolControlador extends RolModelo
{
	//Insertar Rol
	public function CtrInsertarRol()
	{
		$nombre = $_POST['nombre-reg'];
		$consulta1 = mainModel::ejecutar_consulta_simple("SELECT rol_nombre FROM rol WHERE rol_nombre = '$nombre'");

		if ($consulta1->rowCount() >= 1) {
			$alerta=["Alerta"=>"simple",
			"Titulo"=>"Ocurrio un error inesperado",
			"Texto"=>"Rol ya existe",
			"Tipo"=>"error",
			];
		}else{
			$nombrel = mainModel::limpiar_cadena($nombre);

			$dato = ["nombre"=>$nombrel];

			$insertar = RolModelo::MdlInsertarRol($dato);

			if ($insertar->rolCount()>= 1) {
				$alerta=["Alerta"=>"limpiar",
			"Titulo"=>"Insertar Rol",
			"Texto"=>"Rol registrado correctamente",
			"Tipo"=>"success",
			];
			}else{
				$alerta=["Alerta"=>"simple",
			"Titulo"=>"Ocurrio un error inesperado",
			"Texto"=>"No se registro el rol",
			"Tipo"=>"error",
			];
			}
		}
		return mainModel::sweet_alert($alerta);
	}
}