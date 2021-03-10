<?php
if ($peticionAjax) {
    require_once "../modelo/rol.modelo.php";
} else {
    require_once "./modelo/rol.modelo.php";
}

class RolControlador extends RolModelo
{
    public function CtrInsertarRol()
    {
        $nombre    = $_POST['nombre-reg'];
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT rol_nombre FROM rol WHERE rol_nombre = '$nombre'");
        if ($consulta1->rowCount() >= 1) {
            $alerta = ["Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto"  => "El rol ya existe",
                "Tipo"   => "error",
            ];
        } else {
            $nombrel  = mainModel::limpiar_cadena($nombre);
            $dato    = ["nombre" => $nombrel];
            $insertar = RolModelo::MdlInsertarRol($dato);

            if ($insertar->rowCount() >= 1) {
                $alerta = ["Alerta" => "limpiar",
                    "Titulo" => "Insertar Rol",
                    "Texto"  => "Registro Exitoso",
                    "Tipo"   => "success",
                ];
            } else {
                $alerta = ["Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto"  => "No se registro Rol",
                    "Tipo"   => "error",
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    //CONSULTA
    public function CtrMostrarRol()
    {
        $respuesta = RolModelo::MdlMotrarRoles();
        $respuesta = $respuesta->fetchAll();
        $tabla = "";
        $tabla .='<table class="table table-hover text-center">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">NOMBRE</th>
                    <th class="text-center">ACTUALIZAR</th>
                    <th class="text-center">ELIMINAR</th>
                </tr>
            </thead>
            <tbody>';
        if (Count($respuesta) >=1) {
            foreach ($respuesta as $key => $value) {
                $tabla .=
                '<tr> <td>'.$value['rol_id'].'</td>
                 <td>'.$value['rol_nombre'] .'</td>
                    <td>
                    <a href="#!" class = "btn btn-success btn-raised btn-xs">
                    <i class="zmdi zmdi-refresh"> </i>
                    </a>
                    </td>
                    <td>
                    <form class="FormularioAjax" method="POST" data-form = "delete" action="' . SERVERURL. 'ajax/rol.ajax.php">
                    <input type ="hidden" name="rolDel" value = "'. mainModel::encryption($value['rol_id']).'">
                    <button type="submit" class="btn btn-danger btn-raised btn-xs">
                    <i class="zmdi zmdi-delete"></i>
                    </button>
                    <div class = "RespuestaAjax"></div>
                    </form>
                    </td>
                    </tr>';
            }
        } else {
            $tabla .= '<tr><td>"No hay registros en el sistema"</td></tr>';
        }
        $tabla .= '	</tbody>
            </table>';
        return $tabla;
    }
    //ELIMINAR
    public function CtrEliminarRol()
    {
        $idRol = mainModel::decryption($_POST['rolDel']);
        $idRolLc = mainModel::limpiar_cadena($idRol);
        $eliminar = RolModelo::MdlEliminarRol($idRolLc);

        if ($eliminar->rowCount()>=1) {
            $alerta = ["Alerta" => "recargar",
                "Titulo" => "Eliminar datos",
                "Texto"  => "Rol eliminado",
                "Tipo"   => "success",
            ];
        } else {
            $alerta = ["Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto"  => "No se pudo eliminar",
                "Tipo"   => "error",
            ];
        }
        return mainModel::sweet_alert($alerta);
    }
}
