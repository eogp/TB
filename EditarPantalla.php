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

$pantalla = $db->load("pantallas", $_POST["idPantalla"]);
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
        <link rel="stylesheet" href="css/editarPantalla.css" type="text/css"/><!-- Style -->
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
                        <option value="cerrarSesion" >Cerrar sesión</option>
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
                    <div class="row">
                        <img src="images/icono-listacompleta.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Lista completa" onclick="location.href = 'ListaCompleta.php'">
                    </div>
                    <hr class="hr-menu">   
                    <div class="div_menu_selecionado row">
                        <img src="images/icono-editar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Editar">
                    </div>
                    <hr class="hr-menu">
                </div>
                <!-- Fin Menu -->  
                <!-- Principal -->  
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 principal" id="principal">
                    <div>
                        <form action="controlers/editarControler.php" method="post" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" id="tipo" value="<?php echo $pantalla->id_tipos; ?>"/>
                                <div  class="div-etiquetas">
                                    Nombre:

                                </div>
                                <div>
                                    <input id="input-nombre" type="text" name="nombre" class="input-cuerpo" value="<?php echo $pantalla->nombre ?>"/>
                                </div>
                            </div>
                            <div>
                                <div class="div-etiquetas">
                                    Categoría:
                                </div>
                                <div>
                                    <select id="select-categoria" name="categoria" class="select-cuerpo">
                                        <option value=0 disabled="disabled">elija una opción</option>
                                        <?php
                                        $categorias = $db->findAll("CATEGORIAS", "activo = 1");
                                        $retorno = "";
                                        foreach ($categorias as $categoria) {
                                            $retorno = $retorno . '<option value=' . $categoria->id;
                                            if ($categoria->id == $pantalla->id_categorias) {
                                                $retorno = $retorno . ' selected="true" ';
                                            }
                                            $retorno = $retorno . '>' . $categoria->descripcion . '</option>';
                                        }
                                        echo $retorno;
                                        //print_r($categorias);
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="div-texto" 
                            <?php
                            if ($pantalla->id_tipos != 1) {
                                echo 'hidden';
                            }
                            ?> >
                                <div class="div-etiquetas">
                                    Texto:
                                </div>
                                <div>
                                    <textarea id="text-area" rows="4" cols="50" name="texto" maxlength="100" class="area-text" placeholder="Maximo 100 cartaeres"><?php
                                        if ($pantalla->id_tipos == 1) {
                                            echo $pantalla->texto1;
                                        }
                                        ?></textarea>
                                </div>    
                            </div>
                            <div id="div-imagen"<?php
                            if ($pantalla->id_tipos != 2) {
                                echo 'hidden';
                            }
                            ?> >
                                <div class="div-etiquetas">
                                    Imágen:
                                </div>
                                <div>
                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                    <input type="file" accept=".png, .jpg, .jpeg" name="imagen" id="image-upload" />
                                </div>
                            </div>
                            <div id="div-duracion"  <?php
                            if ($pantalla->id_tipos == 3) {
                                echo 'hidden';
                            }
                            ?>>
                                <div class="div-etiquetas">
                                    Duración:
                                </div>
                                <div>
                                    <input type="number" id="min" placeholder="minutos" name="minutos" class="input-cuerpo" value="<?php echo split(':', $pantalla->duracion)[0] ?>"/>
                                </div>
                                <div>
                                    <input type="number" id="sec" placeholder="segundos" name="segundos" class="input-cuerpo" value="<?php echo split(':', $pantalla->duracion)[1] ?>"/>
                                </div>
                            </div>
                            <div id="div-video" <?php
                            if ($pantalla->id_tipos != 3) {
                                echo 'hidden';
                            }
                            ?>>
                                <div class="div-etiquetas">
                                    Link Vimeo:
                                </div>
                                <div>
                                    <input id="video" type="text" placeholder="copie el link aquí" name="video" class="input-cuerpo" value="<?php echo $pantalla->url_vimeo ?>"/>
                                </div>
                            </div>
                            <br>
                            <div class="div-submit">
                                <input type="hidden" name="idpantalla" value="<?PHP echo $pantalla->id ?>"/>
                                <input type="submit" value="Actualizar" id="submit" name="editarPantalla" class="button"/>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- Fin Principal --> 
        </div>
        <!-- Fin Cuerpo -->
    </div>
    <!-- Fin Contenedor principal -->
</body>
<script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
<script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->

<script type="text/javascript" src="js/editarPantalla.js"></script><!-- js -->
</html>
