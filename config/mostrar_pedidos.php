<?php
// Conexión a la base de datos
include('conexion.php');

$consulta = "SELECT * FROM pedidos";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    while ($row = mysqli_fetch_array($resultado)) {
        $id_pedido = $row['id_pedido'];
        $id_cliente = $row['id_cliente'];
        $nombre_producto = $row['nombre_producto'];
        $cantidad_producto = $row['cantidad_producto'];
        $precio_producto = $row['precio_producto'];
        $fecha_pedido = $row['fecha_pedido'];
        $total_pedido = $row['total_pedido'];
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $id_pedido; ?></td>
            <td style="text-align: center;"><?php echo $id_cliente; ?></td>
            <td style="text-align: center;"><?php echo $nombre_producto; ?></td>
            <td style="text-align: center;"><?php echo $cantidad_producto; ?></td>
            <td style="text-align: center;"><?php echo '$' . $precio_producto; ?></td>
            <td style="text-align: center;"><?php echo $fecha_pedido; ?></td>
            <td style="text-align: center;"><?php echo '$' . $total_pedido; ?></td>
            <td style="text-align: center;">
                <button class="btn btn-edit" onclick="openModal1('edit', '<?php echo $id_pedido; ?>', '<?php echo $id_cliente; ?>', '<?php echo $nombre_producto; ?>', '<?php echo $cantidad_producto; ?>', '<?php echo $precio_producto; ?>', '<?php echo $fecha_pedido; ?>', '<?php echo $total_pedido; ?>')">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
            <td style="text-align: center;">
                <button class="btn btn-trash" onclick="openModal1('delete', '<?php echo $id_pedido; ?>')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "No se encontraron pedidos.";
}
?>
