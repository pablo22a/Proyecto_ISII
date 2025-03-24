<?php session_start();
if (isset($_SESSION['id']) && isset($_SESSION['usuario'])) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/fonts.css">
</head>

<body>
    <form action="../config/registro.php" method="post">
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

        <h1>Registro de usuario</h1>
        <label for="">Nombre completo</label>
        <input type="text" name="nombre_completo" placeholder="">

        <label for="">Usuario</label>
        <input type="text" name="usuario" placeholder="">

        <label for="">Contraseña</label>
        <input type="password" name="contraseña" placeholder="">

        <label for="">Confirmar contraseña</label>
        <input type="password" name="c_contraseña" placeholder="">

        <label for="">Correo electrónico</label>
        <input type="email" name="correo_electronico" placeholder="">

        <hr>
        <button type="submit">Registrar</button>
        <button type="button" class="regresar" onclick="window.location.href='admin_login.php';">Regresar</button>
    </form>
</body>

</html>

<?php } else {
    header("Location: index.php");
} ?>