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
        header("Location: ../pages/index.php?error=Usuario requerido");
        exit();
    } elseif (empty($contraseña)) {
        header("Location: ../pages/index.php?error=Contraseña requerida");
        exit();
    } else {
        // Ajusta la consulta para que solo verifique el usuario, no la contraseña.
        $sql = "SELECT * FROM empleados WHERE usuario = '$usuario'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) === 1) {
            $row = mysqli_fetch_assoc($resultado);
            $hash = $row['contraseña']; // Obtiene el hash de la base de datos

            // Verifica la contraseña ingresada contra el hash almacenado
            if (password_verify($contraseña, $hash)) {
                // Inicio de sesión exitoso, configura las variables de sesión
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['contraseña'] = $row['contraseña'];
                $_SESSION['no_empleado'] = $row['no_empleado'];
                $_SESSION['nombre_completo'] = $row['nombre_completo'];
                $_SESSION['correo_electronico'] = $row['correo_electronico'];
                header("Location: ../pages/inicio1.php");
                exit();
            } else {
                // Contraseña incorrecta
                header("Location: ../pages/index.php?error=El usuario o la contraseña son incorrectos");
                exit();
            }
        } else {
            // Usuario no encontrado
            header("Location: ../pages/index.php?error=El usuario o la contraseña son incorrectos");
            exit();
        }
    }
} else {
    header("Location: ../pages/index.php");
    exit();
}
