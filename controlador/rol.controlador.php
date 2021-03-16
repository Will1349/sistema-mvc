<?php
if ($peticionAjax) {
	require_once "../modelo/rol.modelo.php";
} else {
	require_once "./modelo/rol.modelo.php";
}

class RolControlador extends RolModelo
{
	// Insertar
	public function CtrInsertarRol()
	{
		$nombre    = $_POST['nombre-reg'];
		$consulta1 = mainModel::ejecutar_consulta_simple("SELECT rol_nombre FROM rol WHERE rol_nombre = '$nombre'");
		if ($consulta1->rowCount() >= 1) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrio un error",
				"Texto"  => "El rol ya existe",
				"Tipo"   => "error",
			];
		} else {
			$nombrel  = mainModel::limpiar_cadena($nombre);
			$datos    = ["nombre" => $nombrel];
			$insertar = RolModelo::MdlInsertarRol($datos);
			if ($insertar->rowCount() >= 1) {
				$alerta = [
					"Alerta" => "limpiar",
					"Titulo" => "Insertar Rol",
					"Texto"  => "Registro Exitoso",
					"Tipo"   => "success",
				];
			} else {
				$alerta = [
					"Alerta" => "simple",
					"Titulo" => "Ocurrio un error inesperado",
					"Texto"  => "No se registro Rol",
					"Tipo"   => "error",
				];
			}
		}
		return mainModel::sweet_alert($alerta);
	}

	// Consulta
	public function CtrMostrarRol()
	{
		$respuesta = RolModelo::MdlMostrarRoles();
		$respuesta = $respuesta->fetchAll();
		$tabla = "";

		$tabla .= '<table class="table table-hover text-center">
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">NOMBRE</th>
				<th class="text-center">ACTUALIZAR</th>
				<th class="text-center">ELIMINAR</th>
			</tr>
		</thead>
		<tbody>';

		if (count($respuesta) >= 1) {

			foreach ($respuesta as $key => $value) {
				$tabla .= '<tr>
				<td>' . $value['rol_id'] . '</td>
				<td>' . $value['rol_nombre'] . '</td>
				<td>
					<a href="' . SERVERURL . 'categoryup/' . mainModel::encryption($value['rol_id']) . '" class="btn btn-success btn-raised btn-xs">
						<i class="zmdi zmdi-refresh"></i>
					</a>
				</td>
				<td>
					<form class="FormularioAjax" method="POST" data-form="delete" action="' . SERVERURL . 'ajax/rol.ajax.php">
						<input type="hidden" name="rolDel" value="' . mainModel::encryption($value['rol_id']) . '">
					<button type="submit" class="btn btn-danger btn-raised btn-xs">
							<i class="zmdi zmdi-delete"></i>
						</button>
						<div class="RespuestaAjax"></div>
					</form>
				</td>
			</tr>';
			}
		} else {
			$tabla .= '<tr><td> " No hay registros en el sistema" </td></tr>';
		}

		$tabla .= '</tbody>
		</table>';

		return $tabla;
	}

	// Eliminar
	public function CtrEliminarRol()
	{
		echo '<script> console.log("TOY AQUII")</script>';

		$idrol = mainModel::decryption($_POST['rolDel']);
		$idrollc = mainModel::limpiar_cadena($idrol);
		$eliminar = RolModelo::MdlEliminarRol($idrollc);

		if ($eliminar->rowCount() >= 1) {
			$alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Eliminar datos",
				"Texto"  => "Eliminado exitoso",
				"Tipo"   => "success",
			];
		} else {

			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Error eliminar",
				"Texto"  => "No se pudo eliminar el registro",
				"Tipo"   => "error",
			];
		}

		return mainModel::sweet_alert($alerta);
	}

	// Editar
	public function CtrEditarRol()
	{
		$v = explode("/", $_GET['views']);
		$id = mainModel::decryption($v[1]);
		$id = mainModel::limpiar_cadena($id);
		$consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM rol WHERE rol_id = '$id'");
		$respuesta = $consulta1->fetch();
		return $respuesta;
	}

	// Actualizar
	public function CtrActualizarRol()
	{
		$id = mainModel::decryption($_POST["idRolUp"]);
		$nombre = mainModel::limpiar_cadena($_POST["nombreRolUp"]);
		$idl = mainModel::limpiar_cadena($id);

		$datos = [
			"id" => $idl,
			"nombre" => $nombre,
		];

		$actualizar = RolModelo::MdlActualzarRol($datos);
		if ($actualizar->rowCount() >= 1) {
			$alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Actualizar datos",
				"Texto"  => "Actualizado exitoso",
				"Tipo"   => "success",
			];
		} else {

			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Error actualizar",
				"Texto"  => "No se pudo actualizar el registro",
				"Tipo"   => "error",
			];
		}
		return mainModel::sweet_alert($alerta);
	}

	// Paginacion
	public function CtrPaginadorRol($pagina, $nregistros)
	{
		$pagina = mainModel::limpiar_cadena($pagina);
		$nregistros  = mainModel::limpiar_cadena($nregistros);

		$pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;

		$inicio = ($pagina > 0) ? (($pagina * $nregistros) - $nregistros) : 0;

		$conexion = mainModel::conectar();
		$datos = $conexion->query(
			"SELECT SQL_CALC_FOUND_ROWS * FROM rol ORDER BY rol_id ASC LIMIT $inicio, $nregistros"
		);

		$datos = $datos->fetchAll();

		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();
		$npaginas = ceil($total / $nregistros);

		$tabla = "";
		$tabla .= '<table class="table table-hover text-center">
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">NOMBRE</th>
				<th class="text-center">ACTUALIZAR</th>
				<th class="text-center">ELIMINAR</th>
			</tr>
		</thead>
		<tbody>';

		if ($total >= 1 && $pagina <= $npaginas) {


			foreach ($datos as $key => $value) {
				$tabla .= '<tr>
					<td>' . $value['rol_id'] . '</td>
					<td>' . $value['rol_nombre'] . '</td>
					<td>
						<a href="' . SERVERURL . 'categoryup/' . mainModel::encryption($value['rol_id']) . '" class="btn btn-success btn-raised btn-xs">
							<i class="zmdi zmdi-refresh"></i>
						</a>
					</td>
					<td>
						<form class="FormularioAjax" method="POST" data-form="delete" action="' . SERVERURL . 'ajax/rol.ajax.php">
							<input type="hidden" name="rolDel" value="' . mainModel::encryption($value['rol_id']) . '">
						<button type="submit" class="btn btn-danger btn-raised btn-xs">
								<i class="zmdi zmdi-delete"></i>
							</button>
							<div class="RespuestaAjax"></div>
						</form>
					</td>
				</tr>';
			}
		} else {
			if ($total >= 1) {
				$tabla .= '
				<tr>
				<td>
				<a href = "' . SERVERURL . 'categorylist/" class= "btn btn-sm btn-info btn-raised"
				>Haga click para recargar el listado
				</a>
				</td>
				</tr>';
			} else {
				$tabla .= '<tr><td> " No hay registros en el sistema" </td></tr>';
			}
		}
		$tabla .= '</tbody>
		</table>';

		return $tabla;
	}
}
