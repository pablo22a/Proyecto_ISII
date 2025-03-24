<?php 

$inc = include('conexion.php');

if ($inc) {
    // Usar la variable global para determinar qué ventas mostrar
    global $tipoVenta;

    if ($tipoVenta === 'hoy') {
        $consulta = "SELECT SUM(total_venta) AS ventas_de_hoy FROM ventas WHERE fecha = CURRENT_DATE";
    } elseif ($tipoVenta === 'ayer') {
        $consulta = "SELECT SUM(total_venta) AS ventas_de_ayer FROM ventas WHERE fecha = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)";
    } elseif ($tipoVenta === 'mes') {
        $consulta = "SELECT SUM(total_venta) AS ventas_del_mes FROM ventas WHERE MONTH(fecha) = MONTH(CURRENT_DATE) AND YEAR(fecha) = YEAR(CURRENT_DATE)";
    }

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $row = $resultado->fetch_assoc(); 
        
        // Asignar el valor de ventas según el tipo
        $ventas = 0;
        if ($tipoVenta === 'hoy') {
            $ventas = $row['ventas_de_hoy'];
        } elseif ($tipoVenta === 'ayer') {
            $ventas = $row['ventas_de_ayer'];
        } elseif ($tipoVenta === 'mes') {
            $ventas = $row['ventas_del_mes'];
        }

        $ventas = $ventas === null ? 0 : $ventas;

        ?>
        <p><?php echo '$' . number_format($ventas, 2); ?></p>
        <?php
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "Error al conectar a la base de datos.";
}
?>
