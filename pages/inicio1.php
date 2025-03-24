<?php session_start();
if (isset($_SESSION['no_empleado']) && isset($_SESSION['usuario'])) {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Royal Water</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../modal/modal.css">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                display: flex;
            }

            .sidebar {
                display: flex;
                flex-direction: column;
                align-items: start;
                justify-content: start;
                width: 250px;
                background-color: #F6F8FB;
                height: 100vh;
                padding: 20px;
            }

            .sidebar a {
                display: block;
                color: #0D1C52;
                padding: 10px;
                text-decoration: none;
                margin-bottom: 10px;
                width: 90%
            }

            .sidebar a:hover {
                background-color: #DDE4F2;
                border-radius: 5px;
            }

            .sidebar img {
                margin-top: 10px;
                margin-bottom: 20px;
                border-radius: 10px;
            }

            .content {
                flex-grow: 1;
                padding: 30px;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .header h1 {
                color: #0D1C52;
            }

            .header button {
                background-color: #002BFF;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .header button:hover {
                background-color: #001FCC;
            }

            .header a {
                text-decoration: none;
                color: #002BFF;
            }

            .section {
                background-color: #F9FAFC;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 20px;
            }

            .section h2 {
                color: #0D1C52;
                margin-bottom: 15px;
            }

            .inventory-table,
            .order-table {
                width: 100%;
                border-collapse: collapse;
            }

            .inventory-table th,
            .inventory-table td,
            .order-table th,
            .order-table td {
                padding: 10px;
                text-align: left;
            }

            .inventory-table th,
            .order-table th {
                background-color: #DDE4F2;
            }

            .inventory-table td,
            .order-table td {
                border-bottom: 1px solid #DDE4F2;
            }

            .sales-box {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .sales-box div {
                background-color: #F9FAFC;
                padding: 20px;
                text-align: center;
                border-radius: 8px;
                width: 30%;
            }

            .sales-box div h3 {
                margin-bottom: 10px;
                color: #0D1C52;
            }

            .sales-box div p {
                font-size: 24px;
                font-weight: bold;
                color: #002BFF;
            }

            textarea {
                width: 100%;
                height: 100px;
                border-radius: 5px;
                border: 1px solid #DDE4F2;
                padding: 10px;
            }

            .btn-toggle {
                margin-bottom: 10px;
            }

            .btn-toggle button {
                padding: 10px;
                border: none;
                background-color: #E6E8F3;
                color: #0D1C52;
                border-radius: 20px;
                cursor: pointer;
            }

            .btn-toggle button.active {
                background-color: #D0D4EA;
            }

            .btn-toggle button:hover {
                background-color: #C0C4E0;
            }

            .element-container {
                display: flex;
                flex-direction: row;
                min-width: 250px;
                justify-content: space-between;
            }

            .element-container a {
                margin-top: 9px;
                font-size: 16px;
            }

            .btn {
                cursor: pointer;
                border: none;
                border-radius: 5px;
                padding: 8px;
            }

            .btn-edit {
                background-color: #fff;
            }

            .btn-add {
                background-color: #067bff;
                margin-left: 12px;
            }

            .btn-trash {
                background: #f62c2c;
            }

            .active {
                background-color: #D0D4EA;
                border-radius: 8px;
            }

            .sales-table-box h2 {
                margin-bottom: 20px;
                /* Espacio debajo del título */
            }

            .sales-table-box form {
                margin-bottom: 20px;
                /* Espacio debajo del formulario */
            }

            .sales-table-box input {
                width: 15%;
                padding: 10px;
                border-radius: 8px;
                border: none;
                font-size: 16px;
                font-family: sans-serif;
            }

            .sales-table-box a {
                margin: 0 auto;
                text-decoration: none;
                font-family: sans-serif;
                font-size: 16px;
                color: #001FCC;
            }

            #resultados {
                margin-top: 20px;
                /* Espacio arriba del área de resultados */
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- BARRA LATERAL -->
            <div class="sidebar">
                <img src="../img/logo100.png" alt="logo">
                <a href="#" id="control-link" onclick="showSection('control', this)">Panel de Control</a>
                <a href="#" id="inventory-link" onclick="showSection('inventory', this)">Inventario</a>
                <a href="#" id="sales-link" onclick="showSection('sales', this)">Ventas</a>
                <a href="#" id="orders-link" onclick="showSection('orders', this)">Pedidos</a>
            </div>

            <div class="content">
                <!-- PANEL DE CONTROL -->
                <div id="control-section" class="section">
                    <div class="header">
                        <h1>Panel de Control</h1>
                        <div class="element-container">
                            <form action="../config/generarRespaldo.php" method="POST">
                                <button type="submit" style="background: none; border: none; cursor: pointer; color: #002BFF; font-size: 16px;">
                                    <i class="fa-solid fa-database"></i> Generar respaldo
                                </button>
                            </form>
                            <form action="../config/cerrarSesion.php" method="POST">
                                <button type="submit" style="background: none; border: none; cursor: pointer; color: #002BFF; font-size: 16px;">
                                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                                </button>
                            </form>
                        </div>
                    </div>
                    <h2>Tareas pendientes</h2>
                    <p>Revisar inventario</p>
                    <h2>Objetivos</h2>
                    <p>Atender a 20 clientes por cada hora al día</p>
                    <h2>Órdenes Recientes</h2>
                    <p>14</p>
                    <h2>Notas Personales</h2>
                    <textarea placeholder="Escribe tus notas aquí..."></textarea>
                </div>

                <!-- INVENTARIO -->
                <div id="inventory-section" class="section" style="display: none;">
                    <div class="header">
                        <h1>Inventario</h1>
                        <div class="element-container">
                            <a href="../config/reportes_inventario.php">
                                <i class="fas fa-file-pdf"></i>
                                Generar reporte
                            </a>
                            <form action="../config/cerrarSesion.php" method="POST">
                                <button type="submit" style="background: none; border: none; cursor: pointer; color: #002BFF; font-size: 16px;">
                                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                                </button>
                            </form>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: left; align-items: center;">
                        <h2>Productos en Inventario</h2>
                        <button class="btn btn-add" onclick="openModal('add')">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <table class="inventory-table" id="inventory-table">
                        <tr>
                            <th style="text-align: center;">Id</th>
                            <th style="text-align: center;">Producto</th>
                            <th style="text-align: center;">Precio</th>
                            <th style="text-align: center;">Descripcion</th>
                            <th style="text-align: center;">Cantidad</th>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"></th>
                        </tr>
                        <?php include('../config/mostrar_inventario.php'); ?>
                    </table>
                    <?php
                    include('../modal/modal.php');
                    ?>
                </div>

                <!-- VENTAS -->
                <div id="sales-section" class="section" style="display: none;">
                    <div class="header">
                        <h1>Ventas</h1>
                        <form action="../config/cerrarSesion.php" method="POST">
                            <button type="submit" style="background: none; border: none; cursor: pointer; color: #002BFF; font-size: 16px;">
                                <i class="fa-solid fa-right-from-bracket"></i> Salir
                            </button>
                        </form>
                    </div>
                    <div class="sales-box">
                        <div>
                            <h3>Ventas de hoy</h3>
                            <?php
                            $tipoVenta = 'hoy';
                            include('../config/mostrar_ventas.php')
                            ?>
                        </div>
                        <div>
                            <h3>Objetivo del día</h3>
                            <p>$2000</p>
                        </div>
                        <div>
                            <h3>Ventas de ayer</h3>
                            <?php
                            $tipoVenta = 'ayer';
                            include('../config/mostrar_ventas.php')
                            ?>
                        </div>
                    </div>
                    <div class="sales-box">
                        <div>
                            <h3>Ventas del mes</h3>
                            <?php
                            $tipoVenta = 'mes';
                            include('../config/mostrar_ventas.php')
                            ?>
                        </div>
                    </div>
                    <div class="sales-table-box">
                        <h2>Buscar ventas</h2>
                        <form id="busqueda-form"> <!-- Cambiamos a un id para manejarlo con AJAX -->
                            <input type="date" id="fecha" name="fecha" required>
                            <button type="submit" class="btn" style="background-color: #067bff;">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <div id="resultados"></div> <!-- Div para mostrar resultados -->

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluir jQuery -->
                        <script>
                            $(document).ready(function() {
                                $('#busqueda-form').on('submit', function(event) {
                                    event.preventDefault(); // Evitar el envío del formulario normal

                                    var fecha = $('#fecha').val();

                                    $.ajax({
                                        url: '../config/tabla_ventas.php', // Cambia la ruta al script PHP
                                        type: 'POST',
                                        data: {
                                            fecha: fecha
                                        },
                                        success: function(data) {
                                            $('#resultados').html(data); // Muestra los resultados en el div
                                        },
                                        error: function() {
                                            $('#resultados').html('Hubo un error al realizar la búsqueda.'); // Manejo de errores
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div class="sales-table-box">
                        <h2>Generar reportes PDF</h2>
                        <p>Seleccionar Mes y Año para el Reporte de Ventas</p>
                        <form action="../config/reportes_ventas.php" method="GET" style="display: inline;">
                            <label for="mes">Mes:</label>
                            <select name="mes" id="mes" required>
                                <?php
                                // Crear opciones para los meses (1 a 12)
                                for ($i = 1; $i <= 12; $i++) {
                                    $nombreMes = date("F", mktime(0, 0, 0, $i, 10)); // Nombre del mes en inglés
                                    echo "<option value=\"$i\">$nombreMes</option>";
                                }
                                ?>
                            </select>

                            <label for="anio">Año:</label>
                            <select name="anio" id="anio" required>
                                <?php
                                // Crear opciones para los últimos 10 años
                                $anioActual = date("Y");
                                for ($i = $anioActual; $i >= $anioActual - 10; $i--) {
                                    echo "<option value=\"$i\">$i</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" style="background: none; border: none; cursor: pointer; color: #002BFF;">
                                <i class="fas fa-file-pdf"></i> Generar reporte PDF
                            </button>
                        </form>

                    </div>
                </div>

                <!-- PEDIDOS -->
                <div id="orders-section" class="section" style="display: none;">
                    <div class="header">
                        <h1>Pedidos</h1>
                        <div class="element-container">
                            <a href="../config/reportes_pedidos.php">
                                <i class="fas fa-file-pdf"></i>
                                Generar reporte
                            </a>
                            <form action="../config/cerrarSesion.php" method="POST">
                                <button type="submit" style="background: none; border: none; cursor: pointer; color: #002BFF; font-size: 16px;">
                                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                                </button>
                            </form>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: left; align-items: center;">
                        <h2>Pedidos Registrados</h2>
                        <button class="btn btn-add" onclick="openModal1('add')">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <table class="inventory-table" id="orders-table">
                        <tr>
                            <th style="text-align: center;">ID Pedido</th>
                            <th style="text-align: center;">ID Cliente</th>
                            <th style="text-align: center;">Producto</th>
                            <th style="text-align: center;">Cantidad</th>
                            <th style="text-align: center;">Precio</th>
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Total</th>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"></th>
                        </tr>
                        <?php include('../config/mostrar_pedidos.php'); ?>
                    </table>

                    <!-- Incluir el modal -->
                    <?php include('../modal/modalpedidos.php'); ?>
                </div>
                <script>
                    function showSection(section, link) {
                        document.getElementById('control-section').style.display = 'none';
                        document.getElementById('inventory-section').style.display = 'none';
                        document.getElementById('sales-section').style.display = 'none';
                        document.getElementById('orders-section').style.display = 'none';

                        if (section === 'control') {
                            document.getElementById('control-section').style.display = 'block';
                        } else if (section === 'inventory') {
                            document.getElementById('inventory-section').style.display = 'block';
                        } else if (section === 'sales') {
                            document.getElementById('sales-section').style.display = 'block';
                        } else if (section === 'orders') {
                            document.getElementById('orders-section').style.display = 'block';
                        }

                        // Eliminar la clase 'active' de todos los enlaces
                        var links = document.querySelectorAll('a');
                        links.forEach(function(l) {
                            l.classList.remove('active');
                        });

                        // Añadir la clase 'active' al enlace seleccionado
                        link.classList.add('active');
                    }
                </script>
                <script src="../modal/modal.js"></script>
    </body>

    </html>

<?php } else {
    header("Location: index.php");
    exit();
} ?>