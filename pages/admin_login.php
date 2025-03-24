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
    <form action="../config/admin_login.php" method="post">
        <img src="../img/logo100.png" alt="">
        <hr>
        <?php
        if (isset($_GET['error'])) {
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
        <h1>Iniciar sesión como administrador</h1>
        <i class="fa-solid fa-user"></i>
        <label for="">Usuario</label>
        <input type="text" name="usuario" placeholder="Nombre de usuario">

        <i class="fa-solid fa-lock"></i>
        <label for="">Contraseña</label>
        <input type="password" name="contraseña" placeholder="Contraseña">

        <hr>

        <button type="submit" class="iniciar-sesion">Iniciar Sesión</button>
        <button type="button" class="regresar" onclick="window.location.href='../pages/index.php';">Regresar</button>
    </form>
</body>

</html>