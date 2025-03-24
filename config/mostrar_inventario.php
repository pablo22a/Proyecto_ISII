<?php

$inc = include('conexion.php');

if ($inc) {
    $consulta = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        while ($row = $resultado->fetch_array()) {
            $id = $row['id'];
            $nombre = $row['nombre'];
            $precio = $row['precio'];
            $desc = $row['descripcion'];
            $stock = $row['stock'];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $id; ?></td>
                <td style="text-align: center;"><?php echo $nombre; ?></td>
                <td style="text-align: center;"><?php echo '$' . $precio; ?></td>
                <td style="text-align: center;"><?php echo $desc; ?></td>
                <td style="text-align: center;"><?php echo $stock; ?></td>
                <td style="text-align: center;">
                    <button class="btn btn-edit" onclick="openModal('edit', '<?php echo $id; ?>', '<?php echo $nombre; ?>', '<?php echo $precio; ?>', '<?php echo $desc; ?>', '<?php echo $stock; ?>')">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
                <td style="text-align: center;">
                    <button class="btn btn-trash" onclick="openModal('delete', '<?php echo $id; ?>', '<?php echo $nombre; ?>')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            <?php
        }
    }
} else {
    echo "Error de conexion";
}

?>