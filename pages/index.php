<?php
// Evitar caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <form action="../config/login.php" method="post" autocomplete="off">
        <img src="../img/logo400.png" alt="">
        <hr>

        <?php if (isset($_GET['error'])) {
        ?>
            <p class="error">
                <?php
                echo $_GET['error'];
                ?>
            </p>
            <hr>
        <?php
        }
        ?>

        <h1>Usuarios Registrados</h1>
        <i class="fa-solid fa-user"></i>
        <label for="">Usuario</label>
        <input type="text" name="usuario" placeholder="Nombre de usuario" autocomplete="off">

        <i class="fa-solid fa-lock"></i>
        <label for="">Contraseña</label>
        <input type="password" name="contraseña" placeholder="Contraseña" autocomplete="off">

        <hr>

        <button type="submit" class="iniciar-sesion">Iniciar sesión</button>
        <a href="../pages/recuperar_contraseña.php" class="olvide-contraseña">¿Olvidaste tu contraseña?</a>

        <h2>Para crear una cuenta, haz clic <a href="../pages/admin_login.php">aquí</a></h2>
    </form>
</body>

</html>