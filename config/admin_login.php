<?php
session_start();
include('conexion.php');

if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    function validar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validar($_POST['usuario']);
    $contraseña = validar($_POST['contraseña']);

    if (empty($usuario)) {
        header("Location: ../pages/admin_login.php?error=El usuario es requerido");
        exit();
    } else if (empty($contraseña)) {
        header("Location: ../pages/admin_login.php?error=La contraseña es requerida");
        exit();
    } else {

        $sql = "SELECT * FROM administradores WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) === 1) {
            $row = mysqli_fetch_assoc($resultado);
            if ($row['usuario'] === $usuario && $row['contraseña'] === $contraseña) {
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['contraseña'] = $row['contraseña'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre_completo'] = $row['nombre_completo'];
                $_SESSION['correo_electronico'] = $row['correo_electronico'];
                header("Location: ../pages/registrar_usuario.php");
                exit();
            } else {
                header("Location: ../pages/admin_login.php?error=El usuario o la contraseña son incorrectos");
                exit();
            }
        } else {
            header("Location: ../pages/admin_login.php?error=El usuario o la contraseña son incorrectos");
            exit();
        }
    }
} else {
    header("Location: ../pages/admin_login.php");
    exit();
}
