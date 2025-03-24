<?php

    session_start();
    include('conexion.php');

    if (isset($_POST['nombre_completo']) && isset($_POST['usuario']) && isset($_POST['contraseña']) && isset($_POST['c_contraseña']) && isset($_POST['correo_electronico'])) {
        
        function validar($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        $nombre_completo = validar($_POST['nombre_completo']);
        $usuario = validar($_POST['usuario']);
        $contraseña = validar($_POST['contraseña']);
        $c_contraseña = validar($_POST['c_contraseña']);
        $correo_electronico = validar($_POST['correo_electronico']);

        $datos_usuario = 'nombre_completo=' . $nombre_completo . 'usuario=' . $usuario . 'correo_electronico=' . $correo_electronico;
        
        if (empty($nombre_completo)) {
            header("Location: ../pages/registrar_usuario.php?error=Se requiere nombre completo&$datos_usuario");
            exit();
        } else if (empty($usuario)) {
            header("Location: ../pages/registrar_usuario.php?error=Se requiere nombre de usuario&$datos_usuario");
            exit();
        } else if (empty($contraseña)) {
            header("Location: ../pages/registrar_usuario.php?error=Se requiere contraseña&$datos_usuario");
            exit();
        } else if (empty($c_contraseña)) {
            header("Location: ../pages/registrar_usuario.php?error=Se requiere confirmar contraseña&$datos_usuario");
            exit();
        } else if (empty($correo_electronico)) {
            header("Location: ../pages/registrar_usuario.php?error=Se requiere correo electrónico&$datos_usuario");
            exit();
        } elseif ($contraseña !== $c_contraseña) {
            header("Location: ../pages/registrar_usuario.php?error=Las contraseñas no coinciden&$datos_usuario");
            exit();
        } else {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM empleados WHERE usuario = '$usuario'";
            $query = $conexion->query($sql);

            if (mysqli_num_rows($query) > 0) {
                header("Location: ../pages/registrar_usuario.php?error=El usuario ya está registrado");
                exit();
            } else {
                $sql2 = "INSERT INTO empleados(nombre_completo, usuario, contraseña, correo_electronico) VALUES ('$nombre_completo', '$usuario', '$contraseña', '$correo_electronico')";
                $query2 = $conexion->query($sql2);

                if ($query2) {
                    header("Location: ../pages/registrar_usuario_finalizar.php");
                    exit();
                } else {
                    header("Location: ../pages/registrar_usuario.php?error=Ocurrio un error");
                    exit();
                }
            }
        }
    } else {
        header("Location: ../pages/registrar_usuario.php");
        exit();
    }

