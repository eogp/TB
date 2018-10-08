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

/**
 * Description of agregarControler
 *
 * @author enriquegomezpena
 */
require "../db/DBSingleton.php";
require "../entidades/Pantallas.php";

//print_r($_POST);
//VERIFICO QUE EL ORIGEN DEL POST
if (isset($_POST['agregarPantalla'])) {
    //GENERO CONEXION A LA BD POR MEDIO DE BEAN
    $dbSingleton = DBSingleton::getInstance();
    $db = $dbSingleton->getRedBean();
    //GENERO UN BEAN DE NOMBRE PANTALLAS
    $pantallas = $db->dispense("pantallas");
    //CARGO COLUMNAS Y VALORES AL BEAN
    $pantallas->id_tipos = $_POST['tipo'];
    $pantallas->id_categorias = $_POST['categoria'];
    $pantallas->nombre = $_POST['nombre'];
    $pantallas->fecha = date("Y-m-d");

    $pantallas->activo = 1;

    //VERIFICO TIPO DE PANTALLAS PARA 
    switch ($_POST['tipo']) {
        case '1':
            //TEXTO
            $pantallas->texto1 = $_POST['texto'];
            $pantallas->duracion = $_POST['minutos'] . ':' . $_POST['segundos'];
            break;
        case '2':
            //IMAGEN
            $pantallas->duracion = $_POST['minutos'] . ':' . $_POST['segundos'];
            //GUARDO EL BEAN EN LA BD Y OBTENO EL ID
            $id_patalla = $db->store($pantallas);
            //LE ASIGNO AL BEAN EL ID DEVUELTO POR EL INSERT
            $pantallas->id = $id_patalla;
            //AGREGO LA COLUMNA Y VALOR CON LA RUTA DE LA IMAGEN GUADADA
            $pantallas->url_imagen = subirImagen($id_patalla);
            break;
        case '3':
            //VIDEO
            $pantallas->url_vimeo = 'https://player.vimeo.com/video/' . getIdFromURL($_POST['video']);
            break;
    }

    //GUARDO EL BEAN EN LA BD 
    $db->store($pantallas);
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
