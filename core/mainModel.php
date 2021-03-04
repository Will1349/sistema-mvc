<?php
if ($peticionAjax) {
    require_once '../core/configAPP.php';
} else {
    require_once './core/configAPP.php';
}

class mainModel

{
    // Metodo conectar
    protected static function conectar()
    {
        $enlace = new PDO(SGBD, USER, PASS);
        return $enlace;
    }

    // Consultas simples
    protected function ejecutar_consulta_simple($consulta)
    {
        $respuesta = self::conectar()->prepare($consulta);
        $respuesta->execute();
        return $respuesta;
        $respuesta->close();
        $respuesta = null;
    }

    public static function encryption($string)
    {
        $output = false;
        $key    = hash('sha256', SECRET_KEY);
        $iv     = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function decryption($string)
    {
        $key    = hash('sha256', SECRET_KEY);
        $iv     = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    protected function limpiar_cadena($cadena)
    {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src>", "", $cadena);
        $cadena = str_ireplace("<script type=>", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        return $cadena;
    }

    protected function sweet_alert($datos)
    {
        if ($datos['Alerta'] == "simple") {
            $alerta = "<script>
            swal(
                '" . $datos['Titulo'] . "',
                '" . $datos['Texto'] . "',
                '" . $datos['Tipo'] . "',
            )
            </script>";
        } elseif ($datos['alerta' == "recargar"]) {
            $alerta = "
            <script>
            swal({
                title:'" . $datos['Titulo'] . "',
                text:'" . $datos['Texto'] . "',
                icon:'" . $datos['Tipo'] . "',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'Aceptar'
            }). then((function){
                    location.reload();

            });
            </script>";
        } elseif ($datos['alerta' == "limpiar"]) {
            $alerta = "
            <script>
            swal({
                title:'" . $datos['Titulo'] . "',
                text:'" . $datos['Texto'] . "',
                icon:'" . $datos['Tipo'] . "',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'Aceptar'
            }). then((function){
                    $('.FormularioAjax')[0].reset();

            });
            </script>";
        }
        return $alerta;
    }
}
