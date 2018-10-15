<?PHP
session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    //echo "Usuario logueado \n: ";
    //print_r($_SESSION['usuario']);
    //$usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: https://www.rockerapp.com/TB/index.php');
    exit();
}
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
        <link rel="stylesheet" href="css/swiper.css">
        <link rel="stylesheet" href="css/tb.css">
        <link rel="stylesheet" href="css/loadingIndex.css" ><!-- Loading -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body id="bodyindex">

        <!-- Modal Loading -->
        <div id="separador" class="modalLoain">
            <div id="div-hora" class=" row col-lg-12" style="text-align: left; padding-left: 5%; padding-top: 5%">
                <h1 id="hora" style="font-size: 80px;"></h1>
                <h1 id="fecha" style="font-size: 60px;"></h1>
            </div>
            <div class="row">
                <div id="divCampana" class="col-lg-6" style="text-align: left; padding-left: 5%; padding-top: 18%">

                    <div class="row">
                        <div class="col-lg-6">
                            <h1 style="font-size: 80px;">Campana</h1>
                            <h1 id="tempCampana" style="font-size: 80px;"></h1>
                        </div> 

                        <div class="col-lg-6">
                            <img id="imgCampana" height="300" style="padding: 0; margin: 0;">
                        </div>
                    </div>
                </div>
                <div id="divBsAs" class="col-lg-6" style="text-align: left; padding-left: 7%; padding-top: 18%">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 style="font-size: 75px;">Buenos Aires</h1>
                            <h1 id="tempBsAs" style="font-size: 80px;"></h1>
                        </div> 
                         <div class="col-lg-5" style="text-align: right; padding: 0; margin: 0;">
                            <img id="imgBsAs" height="300" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Loading -->

        <div class="swiper-container" id="swiperMain" style="background-color: #006633;">
            <div class="swiper-wrapper" id="main" style="background-color: #006633;">

            </div>
        </div>

        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="https://player.vimeo.com/api/player.js"></script><!-- Vimeo -->

        <script type="text/javascript" src="js/tb.js"></script><!-- js -->
        <script type="text/javascript" src="js/clima.js"></script><!-- js -->
        <script src="js/swiper.js"></script>
    </body>
</html>
