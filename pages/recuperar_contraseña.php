<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form action="../config/recovery.php" method="post">
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
        <h1>Recuperar contraseña</h1>
        <p>Por favor, ingresa tu correo electrónico</p>
        <i class="fa-solid fa-user"></i>
        <label for="">Correo electrónico</label>
        <input type="email" name="correo_electronico" placeholder="user@example.com">
        <hr>
        <button type="submit" class="continuar">Continuar</button>
        <button type="button" class="regresar" onclick="window.location.href='index.php';">Regresar</button>
    </form>
</body>
</html>