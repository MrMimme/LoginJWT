<?php

session_start(); //Iniciar la sesion 

//Elimianr la cookie
setcookie('token');

//Crear un mensaje de error y atribuir para variable global
$_SESSION['msg'] = "<p style='color: green;'>Secion cerrada correctamente</p>";

//Redirecciona el usuario para el archivo index.php
header("Location: index.php");