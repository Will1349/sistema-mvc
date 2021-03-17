<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Administración <small>CATEORÍAS</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
			  		<a href="<?php echo SERVERURL;?>category/" class="btn btn-info">
			  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVA ROL
			  		</a>
			  	</li>
			  	<li>
			  		<a href="<?php echo SERVERURL;?>categorylist/" class="btn btn-success">
			  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CATEGORÍAS
			  		</a>
			  	</li>
			</ul>
		</div>
		<?php
        require_once "./controlador/rol.controlador.php";
        $insRol = new RolControlador();
?>
		<!-- Panel listado de categorias -->
		<div class="container-fluid">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CATEGORÍAS</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">

						<?php
                        $pagina = explode("/", $_GET['views']);
                        echo $insRol->ctrPaginadorRol($pagina [1], 3);
                        ?>

					</div>
					<nav class="text-center">
						<ul class="pagination pagination-sm">
							<li class="disabled"><a href="javascript:void(0)">«</a></li>
							<li class="active"><a href="javascript:void(0)">1</a></li>
							<li><a href="javascript:void(0)">2</a></li>
							<li><a href="javascript:void(0)">3</a></li>
							<li><a href="javascript:void(0)">4</a></li>
							<li><a href="javascript:void(0)">5</a></li>
							<li><a href="javascript:void(0)">»</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
