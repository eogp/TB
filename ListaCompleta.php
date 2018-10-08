<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
<html>
    <head>
        <meta charset="UTF-8">
        <title>TMB</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->      
        <link rel="stylesheet" href="css/listaCompleta.css" type="text/css"/><!-- Style -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="css/loading.css" ><!-- Loading -->

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
                        <input type="button" class="btn-menu" value="Ver demo online" onclick="window.open('tb.php', '_blank')">
                    </div>
                    <hr class="hr-menu">
                    <div class="row">
                        <img src="images/icono-listaactiva.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista activa" onclick="location.href = 'ListaActiva.php'">
                    </div>
                    <hr class="hr-menu">    
                    <div class="div_menu_selecionado row">
                        <img src="images/icono-listacompleta.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Lista completa">
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
                        <table>
                            <tr style="font-size: 18px; color: #006633;">
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
                                <td>
                                    Fecha 
                                </td>
                                <td colspan="2">
                                    Acciones
                                </td>
                                <td>
                                    Estado
                                </td>
                            </tr>
                            <?PHP
                            $pantallas = $db->find("pantallas", "activo=?", [1]);
                            $retorno = '';
                            foreach ($pantallas as $pantalla) {
                                $categoria = $db->load("CATEGORIAS", $pantalla->id_categorias);
                                $tipo = $db->load("TIPOS", $pantalla->id_tipos);
                                $enLista = $db->findOne("listaactiva", "id_pantallas=?", [$pantalla->id]);
                                $retorno = $retorno . "<tr>"
                                        . '<td>' . $pantalla->nombre . '</td>'
                                        . '<td>' . $categoria->descripcion . '</td>'
                                        . '<td>' . $tipo->descripcion . '</td>'
                                        . '<td>';
                                if ($pantalla->id_tipos == 3)
                                    $retorno = $retorno . '-- : --' . '</td>';
                                else
                                    $retorno = $retorno . $pantalla->duracion . '</td>';
                                $retorno = $retorno . '<td>' . $pantalla->fecha . '</td>'
                                        . '<td> <form method="POST" action="EditarPantalla.php">'
                                        . '<input type="hidden" name="idPantalla" value="' . $pantalla->id . '" />'
                                        . '<input type="submit" class="button-verde" value="Editar"/> <img src="images/icono-editar.png" width="16" height="16"/> </form> </td>'
                                        . '<td> <input type="button" class="button-verde" value="Eliminar" onclick="eliminar(' . $pantalla->id . ')"/> <img src="images/icono-borrar.png" width="16" height="16"/>  </td>'
                                        . '<td> <input type="button" onclick="onOff(' . $pantalla->id . ')" value="';
                                if ($enLista)
                                    $retorno = $retorno . 'Publicado' . '" class="button-verde"/></td>';
                                else
                                    $retorno = $retorno . 'No publicado' . '" class="button-red"/></td>';
                                $retorno = $retorno . "</tr>";
                            }
                            echo $retorno;
                            ?>
                        </table>

                    </div>
                    <div class="div-submit">
                        <input type="button" value="Agregar nuevo" class="button" onclick="location.href = 'AgregarNuevo.php'"/>
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
    <script type="text/javascript" src="js/listaCompleta.js"></script><!-- js -->
</html>
