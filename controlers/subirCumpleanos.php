<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../imports/ImportsExcel.php';
$dir_subida = '../excel/';
//                        $dir_subida = '/Applications/XAMPP/xamppfiles/htdocs/demo/excel/';
if (isset($_FILES["excel"])) {
    $fichero_subido = $dir_subida . "excel" . '_' . $_FILES["excel"]['name'];

    if (move_uploaded_file($_FILES["excel"]['tmp_name'], $fichero_subido)) {
        $imports = new ImportsExcel();
        $resultInsert = $imports->import($fichero_subido);
       
    }
    
    header('Location: https://www.rockerapp.com/TB/ListaCompleta.php');
    exit();
}
                    