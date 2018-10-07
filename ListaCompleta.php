<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require "db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();
session_start();
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
                    <select class="selectSesion">
                        <option value="Hola" disabled selected>Hola 
                            <?php
                            if (isset($_POST["usuario"])) {
                                echo $_POST["usuario"];
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
                        <input type="button" class="btn-menu" value="Ver demo online">
                    </div>
                    <hr class="hr-menu">
                    <div class="row">
                        <img src="images/icono-listaactiva.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista activa">
                    </div>
                    <hr class="hr-menu">    
                    <div class="div_menu_selecionado row">
                        <img src="images/icono-listacompleta.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Lista completa">
                    </div>
                    <hr class="hr-menu">   
                    <div class="row">
                        <img src="images/icono-agregar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Agregar nuevo">
                    </div>
                    <hr class="hr-menu">
                </div>
                <!-- Fin Menu -->  
                <!-- Principal -->  
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 principal" id="principal">
                    <table>
                        <tr>
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
                                Fecha de carga
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
                            $retorno = $retorno . "<tr>" .
                                    '<td>' . $pantalla->nombre . '</td>'
                                    . '<td>' . $categoria->descripcion . '</td>'
                                    . '<td>' . $tipo->descripcion . '</td>'
                                    . '<td>';
                            if ($pantalla->id_tipos == 3)
                                $retorno = $retorno . '-- : --' . '</td>';
                            else
                                $retorno = $retorno . $pantalla->duracion . '</td>';
                            $retorno = $retorno . '<td>' . $pantalla->fecha . '</td>'
                                    . '<td > <form method="POST" action="EditarPantalla.php">' 
                                    . '<input type="hidden" name="idPantalla" value="'. $pantalla->id .'" />'
                                    . '<input type="submit" value="Editar"/> </form> </td>'
                                    . '<td > <a onclick="eliminar(' . $pantalla->id . ')"> Eliminar </a> </td>'
                                    . '<td> <a onclick="onOff(' . $pantalla->id . ')">';
                            if ($enLista)
                                $retorno = $retorno . 'Activo' . '</a></td>';
                            else
                                $retorno = $retorno . 'Inactivo' . '</a></td>';
                            $retorno = $retorno . "</tr>";
                        }
                        echo $retorno;
                        ?>
                    </table>

                </div>
                <!-- Fin Principal --> 
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
