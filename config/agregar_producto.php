<?php

include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $desc = $_POST['descripcion'];
    $stock = $_POST['stock'];

    // Consulta SQL

    $consulta = "INSERT INTO productos (nombre, precio, descripcion, stock) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);

    // Comprobar si la consulta se preparo correctamente
    if ($stmt) {
        $stmt->bind_param("sdsi", $nombre, $precio, $desc, $stock);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir o mostrar mensaje
            echo "Producto agregado correctamente";

        } else {
            echo "Error al agregar el producto " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Metodo de solicitud no valido";
}

?>