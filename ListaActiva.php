<?php
session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    //echo "Usuario logueado \n: ";
    //print_r($_SESSION['usuario']);
    //$usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: https://www.rockerapp.com/TB/Login.php');
    exit();

}

require "db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>TMB</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->      
        <link rel="stylesheet" href="css/listaActiva.css" type="text/css"/><!-- Style -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        <!-- ////////// Contenedor principal ////////// -->
        <div class="container-fluid">
            <!-- Header -->
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 header-user ">
                    <img src="images/user.png" class="imagenPerfil"/>
                    <select id="selec-sesion" class="selectSesion">
                        <option value="Hola" disabled selected>Hola <?php
                            if (isset($_SESSION["usuario"])) {
                                echo $_SESSION["usuario"];
                            } else {
                                echo "usuario";
                            }
                            ?>  </option>
                        <option value="cerrarSesion">Cerrar sesión</option>
                    </select>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 header">

                </div>

            </div>
            <!-- Fin Header -->
            <!-- Cuerpo -->
            <div class="row">
                <!-- Menu -->    
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 menu" id="menu">
                    <hr class="hr-menu">
                    <div class="row">
                        <img src="images/icono-verdemo.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Ver demo online" onclick="location.href = 'DemoOnLine.php'">
                    </div>
                    <hr class="hr-menu">
                    <div class="div_menu_selecionado row">
                        <img src="images/icono-listaactiva.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Lista activa">
                    </div>
                    <hr class="hr-menu">    
                    <div class="row">
                        <img src="images/icono-listacompleta.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista completa" onclick="location.href = 'ListaCompleta.php'">
                    </div>
                    <hr class="hr-menu">   
                    <div class="row">
                        <img src="images/icono-agregar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Agregar nuevo" onclick="location.href = 'AgregarNuevo.php'">
                    </div>
                    <hr class="hr-menu">
                </div>
                <!-- Fin Menu -->  
                <!-- Principal -->  
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 principal" id="principal">
                    <div>
                        <table >
                            <tr style="font-size: 18px; color: #006633;">
                                <td colspan="3">
                                    Orden
                                </td>
                                <td>
                                    Nombre
                                </td>           
                                <td>
                                    Categoria
                                </td>
                                <td>
                                    Tipo
                                </td>
                                <td>
                                    Duración
                                </td>
                                <td colspan="2">
                                    Acciones
                                </td>
                            </tr>

                            <?PHP
                            $listaActiva = $db->findAll('listaactiva', 'ORDER BY orden');
                            $retorno = '';
                            $numerador=1;
                            
                            foreach ($listaActiva as $item) {
                                $pantalla = $db->load("pantallas", $item->id_pantallas);
                                $categoria = $db->load("CATEGORIAS", $pantalla->id_categorias);
                                $tipo = $db->load("TIPOS", $pantalla->id_tipos);
                                
                                $retorno = '<tr>'
                                        . '<td>' . $numerador . 'º ' . '</td>'
                                        . '<td>' . '<img src="images/icono-subir.png" width="16" height="16" class="flecha" onclick="subir(' . $item->id . ')"/>' . '</td>'
                                        . '<td>' . '<img src="images/icono-bajar.png" width="16" height="16" class="flecha" onclick="bajar(' . $item->id . ')"/>' . '</td>'
                                        . '<td>' . $pantalla->nombre . '</td>'
                                        . '<td>' . $categoria->descripcion . '</td>'
                                        . '<td>' . $tipo->descripcion . '</td>';
                                if ($pantalla->id_tipos == 3)
                                    $retorno = $retorno . '<td> -- : -- </td>';
                                else
                                    $retorno = $retorno . '<td>' . $pantalla->duracion . '</td>';
                                $retorno = $retorno
                                        . '<td > <form method="POST" action="EditarPantalla.php">'
                                        . '<input type="hidden" name="idPantalla" value="' . $pantalla->id . '" />'
                                        . '<input type="submit" class="button-verde" value="Editar"/> <img src="images/icono-editar.png" width="16" height="16"/> </form> </td>'
                                        . '<td > <input type="button" class="button-red" value="Quitar"onclick="quitar(' . $item->id . ')"/> <img src="images/icono-borrar.png" width="16" height="16"/></td>'
                                        . '</tr>';
                                
                                $numerador++;                                             
                                echo $retorno;
                            }
                            ?>
                        </table>
                    </div>
                    <div class="div-submit">
                        <input type="button" value="Agregar a la lista" class="button" onclick="location.href = 'ListaCompleta.php'"/>
                    </div>
                </div>
                <!-- Fin Principal --> 
            </div>
            <!-- Fin Cuerpo -->
        </div>
        <!-- Fin Contenedor principal -->
    </body>
    <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
    <script type="text/javascript" src="js/listaActiva.js"></script><!-- js -->
</html>
