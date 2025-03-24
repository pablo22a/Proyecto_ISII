<?php
// Conexión a la base de datos
include('conexion.php');

// Eliminar pedido usando el método GET
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_pedido = $_GET['id'];
    $query = "DELETE FROM pedidos WHERE id_pedido='$id_pedido'";
    if (mysqli_query($conexion, $query)) {
        header("Location: ../pages/inicio1.php");
    } else {
        echo "Error al eliminar el pedido: " . mysqli_error($conexion);
    }
    exit;
}

// Verifica si el formulario fue enviado usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // Variables comunes
    $id_pedido = isset($_POST['pedido-id']) ? $_POST['pedido-id'] : null;
    $id_cliente = $_POST['id_cliente'];
    $nombre_producto = $_POST['nombre_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $precio_producto = $_POST['precio_producto'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $total_pedido = $_POST['total_pedido'];

    if ($action === 'add') {
        // Agregar nuevo pedido
        $query = "INSERT INTO pedidos (id_cliente, nombre_producto, cantidad_producto, precio_producto, fecha_pedido, total_pedido) 
                  VALUES ('$id_cliente', '$nombre_producto', '$cantidad_producto', '$precio_producto', '$fecha_pedido', '$total_pedido')";
        if (mysqli_query($conexion, $query)) {
            header("Location: ../pages/inicio1.php");
        } else {
            echo "Error al agregar el pedido: " . mysqli_error($conexion);
        }
    } elseif ($action === 'edit' && $id_pedido) {
        // Modificar pedido existente
        $query = "UPDATE pedidos SET id_cliente='$id_cliente', nombre_producto='$nombre_producto', cantidad_producto='$cantidad_producto',
                  precio_producto='$precio_producto', fecha_pedido='$fecha_pedido', total_pedido='$total_pedido' WHERE id_pedido='$id_pedido'";
        if (mysqli_query($conexion, $query)) {
            header("Location: ../pages/inicio1.php");
        } else {
            echo "Error al actualizar el pedido: " . mysqli_error($conexion);
        }
    }
}

// Cierra la conexión
mysqli_close($conexion);
?>
