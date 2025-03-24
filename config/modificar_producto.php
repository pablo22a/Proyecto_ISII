<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];

    $consulta = "UPDATE productos SET nombre = ?, precio = ?, descripcion = ?, stock = ? WHERE id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssssi", $nombre, $precio, $descripcion, $stock, $id);
    
    if ($stmt->execute()) {
        // Redirigir o mostrar un mensaje de éxito
        echo "Producto " . $nombre ." modificado con éxito.";
    } else {
        // Manejar error
        echo "Error al modificar el producto: " . $conexion->error;
    }
}
?>
