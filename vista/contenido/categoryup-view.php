<?php
require_once "./controlador/rol.controlador.php";

$rol = new RolControlador();
$rol = $rol->CtrEditarRol();
?>

<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Administración <small>ROLES</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
			  		<a href="<?php echo  SERVERURL; ?>category/" class="btn btn-info">
			  			<i class="zmdi zmdi-plus"></i> &nbsp; ACTUALIZAR ROL
			  		</a>
			  	</li>
			  	<li>
			  		<a href="<?php echo  SERVERURL; ?>categorylist/" class="btn btn-success">
			  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE ROLES
			  		</a>
			  	</li>
			</ul>
		</div>

		<!-- Panel nueva categoria -->
		<div class="container-fluid">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp;ACTUALIZAR ROL</h3>
				</div>
				<div class="panel-body">
					<form class="FormularioAjax" data-form="update" action="<?php echo SERVERURL?>ajax/rol.ajax.php" method="POST" autocomplete="off" enctype= "multipart/form-data" >
				    	<fieldset>
				    		<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Información de Roles</legend>
				    		<div class="container-fluid">
				    			<div class="row">

				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Nombre *</label>
                                            <input type="hidden" name = "idRolUp" value="<?php echo mainModel::encryption($rol[ 'rol_id'])?>">
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombreRolUp" required="" maxlength="30" value="<?php echo $rol[ 'rol_nombre']?>">
										</div>
				    				</div>
				    			</div>
				    		</div>
				    	</fieldset>
					    <p class="text-center" style="margin-top: 20px;">
					    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar cambios</button>
					    </p>
						<div class="RespuestaAjax"></div>

						</div>
				    </form>
				</div>
			</div>
		</div>
