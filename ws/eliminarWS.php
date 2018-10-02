<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eliminarWS
 *
 * @author enriquegomezpena
 */

require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();

if(isset($_POST["pantalla"])){
    $pantalla = $db->load( 'pantallas', $_POST["pantalla"] );
    $pantalla->activo=0;
    $db->store( $pantalla );
    //echo print_r($pantalla);
    echo 1;
}else{
    echo 0;
}
