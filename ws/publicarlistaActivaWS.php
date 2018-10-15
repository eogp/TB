<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();

if (isset($_POST["publicar"])) {
    try {
        $db->exec('DELETE FROM listapublicada');
        $db->exec('INSERT INTO listapublicada (SELECT * FROM listaactiva ORDER BY orden)');
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    echo 1;
} else {
    echo 0;
}