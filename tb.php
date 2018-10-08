<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?PHP
session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    //echo "Usuario logueado \n: ";
    //print_r($_SESSION['usuario']);
    //$usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
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
        <div class="swiper-container" id="swiperMain">
            <div class="swiper-wrapper" id="main">
               
            </div>
        </div>
          <!-- Modal Loading -->
        <div class="modalLoain">
        </div>
        <!-- Fin Modal Loading -->
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script src="https://player.vimeo.com/api/player.js"></script><!-- Vimeo -->
        <script type="text/javascript" src="js/tb.js"></script><!-- js -->
        <script src="js/swiper.js"></script>
    </body>
</html>
