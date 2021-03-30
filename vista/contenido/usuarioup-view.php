<!-- Content page -->
<?php
require_once './controlador/usuario.controlador.php';
require_once './controlador/rol.controlador.php';
$us = new UsuarioControlador();
$us = $us->CtrEditarUsuario();

$roles = new RolControlador();
$roles = $roles->CtrMostrarRoles();
?>
<div class="container-fluid">
	<div class="page-header">
		<h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>Create - Read - <strong>Update</strong> - Delete </small></h1>
	</div>
	<!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p> -->
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
            <a href="<?php echo  SERVERURL; ?>admin/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; Actualizar Usuario
            </a>
        </li>
        <li>
            <a href="<?php echo  SERVERURL; ?>adminlist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE USUARIOS
            </a>
        </li>
    </ul>
</div>

<!-- Panel nueva categoria -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; Actualizar Usuario</h3>
        </div>
        <div class="panel-body">
            <form class="FormularioAjax" data-form="update" action="<?php echo SERVERURL ?>ajax/usuario.ajax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Información del Usuario</legend>
                    <div class="container-fluid">
                        <div class="row">

                            <!-- <div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
									<label class="control-label">Nombre *</label>
                                    <input type="hidden" name="idRolUp" value="<?php echo mainModel::encryption($us['rol_id']) ?>">
									<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombreRolUp" required="" maxlength="30" value="<?php echo $us['rol_nombre'] ?>">
								</div>
							</div> -->
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre de usuario *</label>
                                    <input type="hidden" name="idUsuUp" value="<?php echo mainModel::encryption($us['usu_id']) ?>">

                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="usuUp" required="" maxlength="15" value="<?php echo $us['usu_usuario'] ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Contraseña *</label>
                                    <input class="form-control" type="password" name="pass1Up" required="" maxlength="70">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Repita la contraseña *</label>
                                    <input class="form-control" type="password" name="pass2Up" required="" maxlength="70">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                            <label class="control-label">Rol</label>
                                <select class="form-control" name="TipoUsuarioUp" required="">
                                    <option value="<?php echo $us['rol_id']; ?>" id="editUsuario"><?php echo $us['rol_nombre']; ?></option>
                                    <?php foreach ($roles as $key => $value) { ?>
                                        <option value="<?php echo $value['rol_id']; ?>"><?php echo $value['rol_nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar</button>
                </p>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>