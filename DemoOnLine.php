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
        <link rel="stylesheet" href="css/agregarNuevo.css" type="text/css"/><!-- Style -->
        <link href="https://fonts.googleapis.com/css?family=Cabin+Condensed" rel="stylesheet">
        <link rel="stylesheet" href="css/swiper.css">
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
                    <div class="div_menu_selecionado row">
                        <img src="images/icono-verdemo.png" width="16" height="16"/>
                        <input type="button" class="btn-menu-selecionado" value="Ver demo online">
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
                    <div class="row">
                        <img src="images/icono-agregar.png" width="16" height="16"/>
                        <input type="button" class="btn-menu" value="Agregar nuevo">
                    </div>
                    <hr class="hr-menu">
                </div>
                <!-- Fin Menu -->  
                <!-- Principal -->  
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-10 principal" id="principal">
                    <div class="swiper-container" id="swiperMain">
                        <div class="swiper-wrapper" id="main">

                        </div>
                    </div>
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

        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="https://player.vimeo.com/api/player.js"></script><!-- Vimeo -->
        <script src="js/swiper.js"></script>
        <script type="text/javascript" src="js/demoOnLine.js"></script><!-- js -->

    </body>
</html>
