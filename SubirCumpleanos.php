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
        <link rel="stylesheet" href="css/subirCumpleanos.css" type="text/css"/><!-- Style -->
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
                        <option value="Hola" disabled selected>Hola 
                            <?php
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
                    <div class="row">
                        <img src="images/icono-listaactiva.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista activa" onclick="location.href = 'ListaActiva.php'">
                    </div>
                    <hr class="hr-menu">    
                    <div class="row row">
                        <img src="images/icono-listacompleta.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista completa" onclick="location.href = 'ListaCompleta.php'">
                    </div>
                    <hr class="hr-menu">   
                    <div class="row">
                        <img src="images/icono-agregar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Agregar nuevo" onclick="location.href = 'AgregarNuevo.php'">
                    </div>
                    <hr class="hr-menu">
                    <div class="div_menu_selecionado">
                        <img src="images/icono-agregar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Subir excel" >
                    </div>
                    <hr class="hr-menu">
                </div>
                <!-- Fin Menu -->  
                <!-- Principal -->  
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 principal" id="principal">
                    <div>
                        <form method="post" action="controlers/subirCumpleanos.php" enctype="multipart/form-data">
                            <div>
                                 <br/>
                                    <h4>Para garantizar la correcta incorporacion de los datos debe tener en cuenta:</h4>
                                <p >
                                   
                                    <br/>
                                    <br/>
                                    -La extension del archivo debe ser .xls.
                                    <br/>
                                    -El nombre de la hoja debe ser 'Cumpleanos' dado que no se computa la letra ñ.
                                    <br/>
                                    -La columna A debe contener el día del cumpleaños en formato numérico.
                                    <br/>
                                    -La columna B debe contener el mes del cumpleaños en formato numérico.
                                    <br/>
                                    -La columna C debe contener el año del cumpleaños en formato numérico.
                                    <br/>
                                    -La columna D debe contener el nombre dle empleado.
                                    <br/>
                                    -La columna E debe contener el apellido dle empleado.
                                    <br/>
                                    <br/>
                                    * Nota: la fila 1 se reserva para los encabezados.
                                    <br/>
                                    <br/>
                                </p>
                            </div>
                            <div>
                                <input type="file" accept=".xls" name="excel" id="excel-upload" />
                            </div>
                            <br/>
                            <br/>
                            <div>
                                <input type="submit" value="Subir excel" class="button"/>
                            </div>
                        </form>
                    </div>
                </div><!-- Fin Principal --> 
            </div>
            <!-- Fin Cuerpo -->
        </div>
        <!-- Fin Contenedor principal -->

        <!-- Modal Loading -->
        <div class="modalLoain">
        </div>
        <!-- Fin Modal Loading -->
    </body>
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script type="text/javascript" src="js/subirCumpleanos.js"></script><!-- Jquery -->
</html>
