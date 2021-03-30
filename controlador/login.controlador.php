<?php
if ($peticionAjax) {
    require_once "../modelo/login.modelo.php";
} else {
    require_once "./modelo/login.modelo.php";
}
class LoginControlador extends LoginModelo{
	public function CtrIniciarSession(){
		$usuario = mainModel::limpiar_cadena($_POST['usuario']);
        $password = mainModel::limpiar_cadena($_POST['password']);
        $datosLogin = ["usuario" => $usuario, "password" => $password];
        $respuesta = LoginModelo::MdlIniciarSession($datosLogin);
		if ($respuesta->rowCount() == 1) {
			$row = $respuesta->fetch();
            session_start(["name"=> "UIC"]);
            $_SESSION['usuario'] = $row['usu_usuario'];
            $_SESSION['password'] = $row['usu_password'];
            $_SESSION['rol'] = $row['rol_id'];


			$url = SERVERURL . "home/";
			return $urllocation = '<script> window.location = "'.$url.'"</script>';
			
		}else{
			$alerta = [

				"Alerta" => "simple",
				"Titulo" => "error del sistema",
				"Texto" => "usuario y o  contraseña incorrectos",
				"Tipo" => "error",

			];
			
			return mainModel::sweet_alert($alerta);
		}
	}

	public function CtrCerrarSession(){
		session_destroy();
		return header("location:" .SERVERURL. "login/");

	}
}
