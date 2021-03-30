<?php
if ($peticionAjax) {
    require_once "../modelo/usuario.modelo.php";
} else {
    require_once "./modelo/usuario.modelo.php";
}


class UsuarioControlador extends UsuarioModelo
{
    // Insertar
    public function CtrInsertarUsuario()
    {
        $usuario    = $_POST['usuNew'];
        $password    = $_POST['pass1New'];
        $password2    = $_POST['pass2New'];
        $rol    = $_POST['TipoUsuario'];
        if ($password != $password2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto"  => "La contraseña no es semejante!",
                "Tipo"   => "error",
            ];
            return mainModel::sweet_alert($alerta);
        } else {

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_usuario = '$usuario' AND usu_password = '$password'");
            if ($consulta1->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error",
                    "Texto"  => "El usuario ya existe",
                    "Tipo"   => "error",
                ];
            } else {
                $nombrel  = mainModel::limpiar_cadena($usuario);
                $pass1  = mainModel::limpiar_cadena($password);
                $datos    = [
                    "usuario" => $nombrel,
                    "rol" => $rol,
                    "password" => $pass1
                ];
                $insertar = UsuarioModelo::MdlInsertarUsuario($datos);
                if ($insertar->rowCount() >= 1) {
                    $alerta = [
                        "Alerta" => "limpiar",
                        "Titulo" => "Insertar Usuario",
                        "Texto"  => "Registro Exitoso",
                        "Tipo"   => "success",
                    ];
                } else {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto"  => "No se registro Usuario",
                        "Tipo"   => "error",
                    ];
                }
            }
            return mainModel::sweet_alert($alerta);
        }
    }

    // Consulta
    public function CtrMostrarUsuario()
    {
        $respuesta = UsuarioModelo::MdlMostrarUsuarios();
        $respuesta = $respuesta->fetchAll();
        $tabla = "";
        echo 'HOTOT';
        $tabla .= '<table class="table table-hover text-center">
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">USUARIO</th>
				<th class="text-center">CLAVE</th>
				<th class="text-center">ROL</th>
				<th class="text-center">ACTUALIZAR</th>
				<th class="text-center">ELIMINAR</th>
			</tr>
		</thead>
		<tbody>';

        if (count($respuesta) >= 1) {

            foreach ($respuesta as $key => $value) {
                $tabla .= '<tr>
				<td>' . $value['usu_id'] . '</td>
				<td>' . $value['usu_usuario'] . '</td>
				<td>' . $value['usu_password'] . '</td>
				<td>' . $value['rol_nombre'] . '</td>
				<td>
					<a href="' . SERVERURL . 'usuarioup/' . mainModel::encryption($value['usu_id']) . '" class="btn btn-success btn-raised btn-xs">
						<i class="zmdi zmdi-refresh"></i>
					</a>
				</td>
				<td>
					<form class="FormularioAjax" method="POST" data-form="delete" action="' . SERVERURL . 'ajax/usuario.ajax.php">
						<input type="hidden" name="usuDel" value="' . mainModel::encryption($value['usu_id']) . '">
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

    // Editar
    public function CtrEditarUsuario()
    {
        $v = explode("/", $_GET['views']);
        $id = mainModel::decryption($v[1]);
        $id = mainModel::limpiar_cadena($id);
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario as u INNER JOIN rol as r ON u.rol_id = r.rol_id  WHERE usu_id = '$id'");
        $respuesta = $consulta1->fetch();
        return $respuesta;
    }

    // Actualizar
    public function CtrActualizarUsuario()
    {
        mainModel::conectar()->prepare("SET FOREIGN_KEY_CHECKS=0;");
        $id = mainModel::decryption($_POST["idUsuUp"]);
        $usuario = mainModel::limpiar_cadena($_POST["usuUp"]);
        $password = mainModel::limpiar_cadena($_POST["pass1Up"]);
        $password2 = mainModel::limpiar_cadena($_POST["pass2Up"]);
        $rol = $_POST["TipoUsuarioUp"];
        $idl = mainModel::limpiar_cadena($id);
        if ($password != $password2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error actualizar",
                "Texto"  => "No se pudo actualizar el registro revise la contraseña",
                "Tipo"   => "error",
            ];
            return mainModel::sweet_alert($alerta);
        }
        $datos = [
            "id" => $idl,
            "rol" => $rol,
            "usuario" => $usuario,
            "password" => $password,
        ];
        
        $actualizar = UsuarioModelo::MdlActualzarUsuario($datos);
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
        mainModel::conectar()->prepare("SET FOREIGN_KEY_CHECKS=1;");
        return mainModel::sweet_alert($alerta);
    }
    
    // Eliminar
    public function CtrEliminarUsuario()
    {
        
        $idusu = mainModel::decryption($_POST['usuDel']);
        $idusulc = mainModel::limpiar_cadena($idusu);
        $eliminar = UsuarioModelo::MdlEliminarUsuario($idusulc);

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
}
