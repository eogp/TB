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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TMB</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->      
        <link rel="stylesheet" href="css/agregarNuevo.css" type="text/css"/><!-- Style -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        <!-- ////////// Contenedor principal ////////// -->
        <div class="container-fluid">
            <!-- Header -->
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 header-user ">
                    <img src="images/user.png" class="imagenPerfil"/>
                    <select class="selectSesion">
                        <option value="Hola" disabled selected>Hola <?php
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
                    <div class="row">
                        <img src="images/icono-listacompleta.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista completa">
                    </div>
                    <hr class="hr-menu">   
                    <div class="div_menu_selecionado row">
                        <img src="images/icono-agregar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Agregar nuevo">
                    </div>
                    <hr class="hr-menu">
                </div>
                <!-- Fin Menu -->  
                <!-- Principal -->  
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 principal" id="principal">
                    <div>
                        <form action="controlers/agregarControler.php" method="post" enctype="multipart/form-data">
                            <div>
                                <div>
                                    Fecha:
                                </div>
                                <div>
                                    <input type="date" name="fecha">
                                </div>
                            </div>
                            <div>
                                <div>
                                    Nombre:
                                </div>
                                <div>
                                    <input type="text" name="nombre">
                                </div>
                            </div>
                            <div>
                                <div>
                                    Categoría:
                                </div>
                                <div>
                                    <select name="categoria">
                                        <option value=0 selected="true" disabled="disabled">elija una opción</option>
                                        <?php
                                        $categorias = $db->findAll("CATEGORIAS", "activo = 1");
                                        $retorno = "";
                                        foreach ($categorias as $categoria) {
                                            $retorno = $retorno . '<option value=' . $categoria->id . '>' . $categoria->descripcion . '</option>';
                                        }
                                        echo $retorno;
                                        //print_r($categorias);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    Tipo:
                                </div>
                                <div>
                                    <select id="select-tipo" name="tipo">
                                        <option value=0 selected="true" disabled="disabled">elija una opción</option>
                                        <?php
                                        $tipos = $db->findAll("TIPOS", "activo = 1");
                                        $retorno = "";
                                        foreach ($tipos as $tipo) {
                                            $retorno = $retorno . '<option value=' . $tipo->id . '>' . $tipo->descripcion . '</option>';
                                        }
                                        echo $retorno;
                                        //print_r($categorias);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="div-texto" hidden>
                                <div>
                                    Texto:
                                </div>
                                <div>
                                    <input type="text" name="texto">
                                </div>    
                            </div>
                            <div id="div-imagen" hidden>
                                <div>
                                    Imágen:
                                </div>
                                <div>
                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                    <input type="file" accept=".png, .jpg, .jpeg" name="imagen" id="image-upload" />
                                </div>
                            </div>
                            <div id="div-duracion" hidden>
                                <div>
                                    Duración:
                                </div>
                                <div>
                                    <input type="number" placeholder="minutos" name="minutos">
                                </div>
                                <div>
                                    <input type="number" placeholder="segundos" name="segundos">
                                </div>
                            </div>
                            <div id="div-video" hidden>
                                <div>
                                    Link Vimeo:
                                </div>
                                <div>
                                    <input type="text" placeholder="copie el link aquí" name="video">
                                </div>
                            </div>
                            <br>
                            <div>
                                <input type="submit" value="Agregar" disabled="true" id="submit" name="agregarPantalla">
                            </div>
                        </form>
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
    <script type="text/javascript" src="js/agregarNuevo.js"></script><!-- js -->
</html>
