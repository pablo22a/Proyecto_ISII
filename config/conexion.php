<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "royalwaterdb";

    $conexion = mysqli_connect($host, $user, $pass, $db);

    if (!$conexion) {
        echo "Conexion fallida";
    }