<div class="full-box login-container cover">
	<form action="" method="POST" autocomplete="off" class="logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
		<div class="form-group label-floating">
			<label class="control-label" for="UserName">Usuario</label>
			<input class="form-control" id="UserName" type="text" name="usuario" required="">
			<p class="help-block">Escribe tú nombre de usuario</p>
		</div>
		<div class="form-group label-floating">
			<label class="control-label" for="UserPass">Contraseña</label>
			<input class="form-control" id="UserPass" type="password" name="password" required="">
			<p class="help-block">Escribe tú contraseña</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="Iniciar sesión" class="btn btn-info" style="color: #FFF;">
		</div>
	</form>
</div>

<?php
if (isset($_POST['usuario']) && isset($_POST['password'])) {
	require_once "./controlador/login.controlador.php";

	$login = new LoginControlador();

	echo $login->CtrIniciarSession();
}
?>	