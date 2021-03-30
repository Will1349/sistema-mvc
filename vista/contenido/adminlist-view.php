<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
		<h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>Create - <strong>Read</strong> - Update - Delete</small></h1>
	</div>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
		<li>
			<a href="<?php echo  SERVERURL; ?>admin/" class="btn btn-info">
				<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO ADMINISTRADOR
			</a>
		</li>
		<li>
			<a href="<?php echo  SERVERURL; ?>adminlist/" class="btn btn-success">
				<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE ADMINISTRADORES
			</a>
		</li>

	</ul>
</div>


<?php require_once '../sistema-mvc-git/controlador/usuario.controlador.php';
$i = new UsuarioControlador();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE ADMINISTRADORES</h3>
		</div>

		<div class="panel-body">
			<div class="table-responsive">

			<?php
			echo $i->CtrMostrarUsuario();
			?>


			</div>




		</div>
	</div>
</div>