<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();
$retorno = [];
$pantallas = [];
$categorias=[];
if (isset($_POST['pantalla']) && $_POST['pantalla'] == 1) {
    $listaActiva = $db->findAll('listaactiva', 'ORDER BY orden');
    foreach ($listaActiva as $item) {
        $pantalla = $db->load('pantallas', $item->id_pantallas);
        $pantallas[]= $pantalla;
    }
    $categoriaDB = $db->findAll('CATEGORIAS');
    foreach ($categoriaDB as $item){
        $categorias[]=$item;
    }
    $retorno= ['pantallas'=> $pantallas];
    $retorno+= ["categorias" => $categorias];

}

echo json_encode($retorno);
