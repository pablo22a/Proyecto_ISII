<?php
ob_start(); // Inicia el almacenamiento en búfer de salida

// Conectar a la base de datos
include('conexion.php');

// Obtener mes y año desde el formulario
$mes = isset($_GET['mes']) ? $_GET['mes'] : date('m'); // Si no se envía, usa el mes actual
$anio = isset($_GET['anio']) ? $_GET['anio'] : date('Y'); // Si no se envía, usa el año actual

// Consulta SQL para obtener las ventas del mes y año seleccionados
$sql = "SELECT folio, producto_nombre, cantidad, total_venta, fecha 
        FROM ventas 
        WHERE MONTH(fecha) = ? AND YEAR(fecha) = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('ii', $mes, $anio);
$stmt->execute();
$result = $stmt->get_result();

// Generar el contenido HTML para el PDF
?>
<style>
    body {
        font-family: sans-serif;
        position: relative;
        background: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente para el texto */
    }
    .watermark {
        position: absolute;
        top: 50%; /* Centrado verticalmente */
        left: 50%; /* Centrado horizontalmente */
        transform: translate(-50%, -50%) rotate(-45deg); /* Inclina el texto 45 grados y centra */
        font-size: 5em; /* Ajusta el tamaño del texto */
        color: rgba(0, 0, 0, 0.1); /* Color negro con baja opacidad */
        z-index: -1; /* Coloca el texto detrás del contenido */
        white-space: nowrap; /* Asegura que el texto no se envuelva */
    }
    .reportes {
        width: 100%;
        border-collapse: collapse;
    }
    .reportes th,
    .reportes td {
        padding: 10px;
        text-align: center;
    }
    .reportes th {
        background-color: #4682ca;
    }
    .reportes td {
        border-bottom: 1px solid #bed1f7;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative; /* Asegura que el contenedor contenga los elementos en su posición */
        z-index: 1; /* Asegura que el contenido esté por encima de la marca de agua */
    }
    .header {
        display: flex;
        align-items: flex-start;
        width: 100%;
    }
    .header img {
        width: 300px;
        height: auto;
        vertical-align: top;
        margin-right: 10px;
    }
    .header h1 {
        display: inline-block;
        margin: 0;
        font-size: 1.5em;
        vertical-align: middle;
    }
</style>

<div class="container">
    <div class="watermark">Royal Water</div> <!-- Añadir texto como marca de agua -->
    <div class="header">
        <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/royalwaterv1.0/img/logo400.png" alt="logo_empresa">
        <h1>Reporte de Ventas Royal Water</h1>
        <p>Tipo de reporte: Mensual</p>
        <p>Mes: <?php echo date("F", mktime(0, 0, 0, $mes, 10)); ?> <?php echo $anio; ?></p>
    </div>
    <table class="reportes">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total Venta</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['folio']; ?></td>
                        <td><?php echo $row['producto_nombre']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo '$' . number_format($row['total_venta'], 2); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['fecha'])); ?></td>
                    </tr>
            <?php }
            } else { ?>
                <tr>
                    <td colspan="5">No se encontraron ventas para el mes y año seleccionados.</td>
                </tr>
            <?php } 
            $stmt->close();
            $conexion->close();
            ?>
        </tbody>
    </table>
</div>

<?php
// Obtener el contenido HTML generado
$html = ob_get_clean();

// Cargar la biblioteca Dompdf
require_once('../dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$dompdf = new Dompdf();

// Configuración de Dompdf
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

// Cargar el HTML y generar el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();

// Variable que guarda el PDF para enviarlo por correo
$pdfOutput = $dompdf->output();


$dompdf->stream("reporte_ventas_{$mes}_{$anio}.pdf", array("Attachment" => false)); // Abre el PDF en el navegador


// Funcion para enviar el pdf por correo
//sendReportByEmail($pdfOutput, $mes, $anio);

// Enviar el reporte por correo electronico
function sendReportByEmail($pdfOutput, $mes, $anio) {

    // Importar PHPMailer
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                                  
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                    
        $mail->Username   = 'pabloarellanoxd@gmail.com';       
        $mail->Password   = 'cglw zgbp urlh ypkc'; // Contrasena de aplicacion                     
        $mail->Port       = 587;   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        

        // Configuración de correo
        $mail->setFrom('pabloarellanoxd@gmail.com', 'Remitente');
        $mail->addAddress('pabloarellanoxd@gmail.com', 'Destinatario');
        $mail->Subject = "Reporte de Ventas - $mes/$anio";
        $mail->Body = 'Adjunto encontrarás el reporte de ventas mensual en formato PDF.';

        // Adjuntar el PDF desde la variable de memoria
        $mail->addStringAttachment($pdfOutput, "reporte_ventas_{$mes}_{$anio}.pdf");

        // Enviar el correo
        $mail->send();
        echo "Correo enviado exitosamente.";
    } catch (Exception $e) {
        echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
