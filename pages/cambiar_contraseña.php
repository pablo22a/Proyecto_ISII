<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseñas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <form action="../config/cambiarContraseña.php" method="post">
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
        <h1>Recupera tu contraseña</h1>
        <i class="fa-solid fa-lock"></i>
        <label for="">Nueva contraseña</label>
        <input type="password" name="n_pass" placeholder="Nueva contraseña">

        <i class="fa-solid fa-lock"></i>
        <label for="">Confirma tu nueva contraseña</label>
        <input type="password" name="c_n_pass" placeholder="Confirma tu nueva contraseña">

        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <hr>

        <div class="btn-centrar">
            <button type="submit">Cambiar contraseña</button>
        </div>
        
    </form>
</body>

</html>