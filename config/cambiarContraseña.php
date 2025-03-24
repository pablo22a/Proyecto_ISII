<?php

require_once('conexion.php');

$no_empleado = $_POST['id'];
$n_pass = $_POST['n_pass'];
$c_n_pass = $_POST['c_n_pass'];

if (empty($n_pass)) {
    header("Location: ../pages/cambiar_contraseña.php?error=Debes escribir tu nueva contraseña&id=" . urlencode($no_empleado));
    exit();
}
else if (empty($c_n_pass)) {
    header("Location: ../pages/cambiar_contraseña.php?error=Debes confirmar tu nueva contraseña&id=" . urlencode($no_empleado));
    exit();
} 
elseif ($n_pass != $c_n_pass) {
    header("Location: ../pages/cambiar_contraseña.php?error=Las contraseñas no coinciden&id=" . urlencode($no_empleado));
    exit();
} else {
    $n_pass = password_hash($n_pass, PASSWORD_DEFAULT);
    $query = "UPDATE empleados set contraseña= '$n_pass' WHERE no_empleado= '$no_empleado'";
    $result = $conexion->query($query);
    header("Location: ../pages/cambiar_contraseña_finalizar.php");
}





