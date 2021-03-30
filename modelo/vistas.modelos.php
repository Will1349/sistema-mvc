<?php

class VistasModelo
{
    protected function MdlMostrarVistas($vistas)
    {
        $listaBlanca = ["categoryup","admin", "adminlist", "adminsearch", "adminup", "book",
         "bookconfig", "bookinfo", "catalog", "category", "categorylist", "client", "clientlist",
          "clientsearch", "company", "companylist", "deleteuser", "home", "myaccount", "mydata", 
          "provider", "providerlist", "search", "404", "salir","usuarioup"];
        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./vista/contenido/" . $vistas . "-view.php")) {
                $contenido = "./vista/contenido/" . $vistas . "-view.php";
            } else {
                $contenido = "login";
            }
        } elseif ($vistas == "login") {
            $contenido = "login";
        } elseif ($vistas == "index") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}
