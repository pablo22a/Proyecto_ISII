<?php

ob_start();

include('conexion.php');
$fecha = date('Y-m-d H:i:s');

$sql = "SELECT id, nombre, precio, descripcion, stock FROM productos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

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
        <h1>Reporte de inventario Royal Water</h1>
        <p>Fecha: <?php echo $fecha ?></p>
    </div>
    <table class="reportes">
        <thead>
            <tr>
                <th>Id</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                    </tr>
            <?php    }
            } else {
                echo "Ocurrió un error al mostrar la tabla.";
            } 
            
            $stmt->close();
            $conexion->close();
            ?>
        </tbody>
    </table>
</div>

<?php
$html=ob_get_clean();
//echo $html;

require_once('../dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();

// Variable que guarda el PDF para enviarlo por correo
$pdfOutput = $dompdf->output();


$dompdf->stream("reporte_inventario_$fecha.pdf", array("Attachment" => false));


// Funcion para enviar el pdf por correo
//sendReportByEmail($pdfOutput, $fecha);

// Enviar el reporte por correo electronico
function sendReportByEmail($pdfOutput, $fecha) {

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
        $mail->Subject = "Reporte de Inventario - $fecha";
        $mail->Body = 'Adjunto encontrarás el reporte de inventario en formato PDF.';

        // Adjuntar el PDF desde la variable de memoria
        $mail->addStringAttachment($pdfOutput, "reporte_inventario_{$fecha}.pdf");

        // Enviar el correo
        $mail->send();
        echo "Correo enviado exitosamente.";
    } catch (Exception $e) {
        echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
