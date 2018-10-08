<?php

session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    //echo "Usuario logueado \n: ";
    //print_r($_SESSION['usuario']);
    //$usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: ../Login.php');
    exit();
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "../db/DBSingleton.php";
require "../entidades/Pantallas.php";
//print_r($_POST);
if (isset($_POST['editarPantalla'])) {

    //GENERO CONEXION A LA BD POR MEDIO DE BEAN
    $dbSingleton = DBSingleton::getInstance();
    $db = $dbSingleton->getRedBean();
    //GENERO UN BEAN DE NOMBRE PANTALLAS
    $pantalla = $db->load("pantallas", $_POST['idpantalla']);
    $pantalla->nombre = $_POST['nombre'];
    $pantalla->id_categorias = $_POST['categoria'];
    //VERIFICO TIPO DE PANTALLAS PARA 
    switch ($pantalla->id_tipos) {
        case 1:
            //TEXTO
            $pantalla->texto1 = $_POST['texto'];
            $pantalla->duracion = $_POST['minutos'] . ':' . $_POST['segundos'];
            break;
        case 2:
            //IMAGEN
            $pantalla->duracion = $_POST['minutos'] . ':' . $_POST['segundos'];
            //AGREGO LA COLUMNA Y VALOR CON LA RUTA DE LA IMAGEN GUADADA
            $pantalla->url_imagen = subirImagen($pantalla->id);
            break;
        case 3:
            //VIDEO
            $pantalla->url_vimeo = 'https://player.vimeo.com/video/' . getIdFromURL($_POST['video']);
            break;
    }

    //GUARDO EL BEAN EN LA BD 
    $db->store($pantalla);
    header('Location: ../ListaCompleta.php');
    exit();

//return $id_pantallas = $db->store($pantallas);
}

//SUBIR IMAGENES Y RETORNAR RUTA EN SERVIDOR
function subirImagen($id_patalla) {
    // MODIFICAR RUTA AL SUBIR AL HOSTING
    $dir_subida = $_SERVER['DOCUMENT_ROOT'] . '/tb/imagenes_pantallas/';

    if (isset($_FILES['imagen'])) {
        //GUARDADO  DE IMAGEN
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $dir_subida . 'imagen_pantalla_id_' . $id_patalla)) {
            //return $dir_subida.'imagen_pantalla_id_'.$id_patalla;
            return '/imagenes_pantallas/' . 'imagen_pantalla_id_' . $id_patalla;
        }
    }
}

//OBTENER ID VIDEO
function getIdFromURL($url) {

    $array[] = split('/', $url);
    $aux = end($array[count($array) - 1]);

    return strval($aux);
}
