<?php
set_time_limit(300); // 5 minutos

// Configuración de la zona horaria
date_default_timezone_set('America/Hermosillo'); // Establecer zona horaria a Hermosillo, Sonora

// Configuración de la base de datos
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'royalwaterdb';

// Archivo de respaldo
$backupFile = 'C:\xampp\htdocs\royalwaterv1.0\respaldo\respaldo_' . date('Y-m-d_H-i-s') . '.sql';

// Comando para realizar el respaldo
$command = "C:\\xampp\\mysql\\bin\\mysqldump -u$dbUser $dbName > $backupFile 2>&1";

// Ejecutar el comando
exec($command, $output, $result);

// Verificar el resultado de la ejecución
if ($result === 0) {
    echo "Respaldo creado exitosamente.";
} else {
    echo "Error al crear el respaldo.";
}
?>
