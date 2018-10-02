<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of onOffWS
 *
 * @author enriquegomezpena
 */
require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();

if(isset($_POST["pantalla"])){
   
    $listaActiva=$db->findOne("listaactiva","id_pantallas=?",[$_POST["pantalla"]]);
    if(isset($listaActiva)){
        $db->trash($listaActiva);
        
    }else{
        $listaActiva=$db->dispense("listaactiva");
        $orden=$db->getCol( 'SELECT MAX(orden) AS ORDEN FROM listaactiva;' );
        $listaActiva->id_pantallas=$_POST["pantalla"];
        $listaActiva->orden=$orden[0]+1;
        $db->store( $listaActiva );
    }
   
   // echo print_r($listaActiva);
    echo 1;
}else{
    echo 0;
}
