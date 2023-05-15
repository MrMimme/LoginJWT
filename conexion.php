<?php

//Credenciales de la base de datos

$host = "localhost";
$user = "root";
$pas  = "";
$dbname = "login_register";

try {
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pas);
    //echo "Conexion con base de datos realizada correctamente";
}catch(PDOException $err){
    echo "Error: Conexion con la base de datos no se completo. Error generado " . $err->getMessage();
}