<?php
require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();
if (isset($_POST["usuario"]) && isset($_POST["pass"])) {
    $user = $db->getCell('select * from user where name="' . $_POST["usuario"] . '" and pass="' . $_POST["pass"] . '"');
    if ($user) {
        session_start();
        $_SESSION['usuario'] = $_POST["usuario"];
        header('Location: ../tb.php');
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

