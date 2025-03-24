<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    
    // Consulta para eliminar el producto
    $consulta = "DELETE FROM productos WHERE id = ?";
    
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Producto eliminado con éxito.";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
}
?>
