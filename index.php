<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->      
        <link rel="stylesheet" href="css/index.css" type="text/css"/><!-- Style -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body class="body ">
        <?php
        // put your code here
        ?>

        <div class="cuerpo">
            <form action="controlers/loginTBControler.php" method="POST">
                <div class="row">
                    <div class="titulo">Bienvenido, por favor completa tus datos para ingresar.</div>
                </div>
                <br>
                <br>
                <div class="div-form">
                    <div class="row texto_izq div-form">
                        Usuario
                    </div>
                    <div class="row div-form">
                        <input name="usuario" type="text">
                    </div>
                    <br>
                    <div class="row texto_izq div-form">
                        Password 
                    </div>
                    <div class="row div-form">
                        <input name="pass" type="password">
                    </div>
                    <br>
                    <div class="row div-form">
                        <input class="button" type="submit" value="Entrar">
                    </div>
                    <div class="link" href="#">
                        Olvidaste tu password?
                    </div>
                </div>
            </form>
            <footer class="page-footer">
                <div class="row">

                    <div>Soporte y ayuda ténica info@potitihandsen.com</div>
                </div>

            </footer>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    </body>
</html>
