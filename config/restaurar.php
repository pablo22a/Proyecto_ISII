<?php
// Configura las credenciales de la base de datos
$host = 'localhost'; // Cambia según tu configuración
$user = 'root'; // Cambia según tu configuración
$password = ''; // Cambia según tu configuración
$database = 'royalwaterdb'; // Cambia por el nombre de tu base de datos

// Ruta al archivo SQL que deseas restaurar
$backupFile = 'C:/xampp/htdocs/royalwaterv1.0/respaldo/respaldo.sql';

// Crear conexión a la base de datos
$conn = new mysqli($host, $user, $password, $database);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Leer el archivo SQL
$sql = file_get_contents($backupFile);

// Dividir el contenido en consultas SQL
$queries = explode(';', $sql);

// Ejecutar cada consulta
foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) { // Verifica que la consulta no esté vacía
        echo "Ejecutando consulta: $query<br>"; // Depuración
        if ($conn->query($query) === false) {
            echo "Error en la consulta: " . $conn->error . "<br>";
        }
    }
}

echo "La base de datos ha sido restaurada exitosamente.";

// Cerrar la conexión
$conn->close();
?>


// Ruta al archivo SQL que deseas restaurar
$backupFile = 'C:/xampp/htdocs/royalwaterv1.0/respaldo/respaldo.sql';
