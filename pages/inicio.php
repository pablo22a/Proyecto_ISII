<?php session_start();
if (isset($_SESSION['no_empleado']) && isset($_SESSION['usuario'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenido</title>
        <link rel="stylesheet" href="../css/styles_inicio.css">
        <link rel="stylesheet" href="../css/fonts.css">
    </head>

    <body>

        <header>
            <h1>Royal Water</h1>
        </header>
        <section>
            <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
            <a href="index.php">Cerrar sesion</a>
            <a href="">Restablecer Tablas</a>
        </section>

    </body>

    </html>
<?php } else {
    header("Location: index.php");
    exit();
} ?>