<?php include 'core/configGeneral.php'; ?>
<?php
session_start();
$peticionAjax = false;
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURL ?>/vista/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL ?>vista/css/sweetalert2.css">
	<script type="text/javascript" src="<?php echo SERVERURL ?>vista/js/sweetalert2.min.js"></script>
</head>

<body>


	<?php
	require_once "./controlador/vista.controlador.php";
	$vt = new VistaControlador();
	$vistas = $vt->CtrMostrarVistas();
	if ($vistas == "login" || $vistas == "404") :
		if ($vistas == "login") {
			require_once "./vista/contenido/login-view.php";
		} else {
			require_once "./vista/contenido/404-view.php";
		}
	else :


		include 'modulos/sidebar.php'; ?>
		<!-- Content page-->
		<section class="full-box dashboard-contentPage">
			<!-- NavBar -->
			<?php include 'modulos/navbar.php'; ?>
			<!-- Content page -->

			<?php require_once $vistas; ?>


		</section>
	<?php endif; ?>

	<!--====== Scripts -->
	<?php include 'modulos/scripts.php'; ?>
</body>

</html>