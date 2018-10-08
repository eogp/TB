<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();

if (isset($_POST['subir'])) {
    $itemActual = $db->load('listaactiva', $_POST['subir']);
    $anteriores = $db->find('listaactiva', 'orden <' . $itemActual->orden . ' ORDER BY orden');
    if (isset($anteriores) && count($anteriores) > 0) {
        $itemAnterior = end($anteriores);
        $ordenActual = $itemActual->orden;
        $ordenAnterior = $itemAnterior->orden;
        $itemActual->orden = $ordenAnterior;
        $itemAnterior->orden = $ordenActual;
        $db->store($itemActual);
        $db->store($itemAnterior);
        echo '1';
    } else {
        echo '0';
    }
}
if (isset($_POST['bajar'])) {
    $itemActual = $db->load('listaactiva', $_POST['bajar']);
    $proximos = $db->find('listaactiva', 'orden >' . $itemActual->orden . ' ORDER BY orden DESC');
    if (isset($proximos) && count($proximos) > 0) {
        $itemAnterior = end($proximos);
        $ordenActual = $itemActual->orden;
        $ordenAnterior = $itemAnterior->orden;
        $itemActual->orden = $ordenAnterior;
        $itemAnterior->orden = $ordenActual;
        $db->store($itemActual);
        $db->store($itemAnterior);
        echo '1';
    } else {
        echo '0';
    }
}
if (isset($_POST['quitar'])) {
    $itemActual = $db->load('listaactiva', $_POST['quitar']);
    $db->trash($itemActual);

    echo '1';
}
