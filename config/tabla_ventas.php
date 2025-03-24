<?php
include('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];

    $sql = "SELECT folio, producto_nombre, cantidad, total_venta, fecha FROM ventas WHERE DATE(fecha) = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mostrar resultados
        echo "<table class='inventory-table'>";
        echo "<tr><th>Folio</th><th>Producto</th><th>Cantidad</th><th>Total Venta</th><th>Fecha</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["folio"] . "</td><td>" . $row["producto_nombre"] . "</td><td>" . $row["cantidad"] . "</td><td>" . $row["total_venta"] . "</td><td>" . $row["fecha"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la fecha seleccionada.";
    }

    $stmt->close();
    $conexion->close();
}
?>







