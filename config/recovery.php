<?php
ob_start(); // Iniciar el buffer de salida

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

require_once('conexion.php');
$correo_electronico = $_POST['correo_electronico'];
$query = "SELECT * FROM empleados WHERE correo_electronico = '$correo_electronico'";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                                  
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                    
        $mail->Username   = 'pabloarellanoxd@gmail.com';       
        $mail->Password   = 'cglw zgbp urlh ypkc'; // Contrasena de aplicacion                     
        $mail->Port       = 587;   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                  


        //Recipients
        $mail->setFrom('pabloarellanoxd@gmail.com', 'Mailer');
        $mail->addAddress('pabloarellanoxd@gmail.com', 'Joe User');     //Add a recipient
        $mail->CharSet = 'UTF-8';

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = 'Este es un correo generado para solicitar la recuperación de tu contraseña, por favor,
        visita la página <a href="http://localhost/royalwaterv1.0/pages/cambiar_contraseña.php?id='.$row['no_empleado'].'">Recuperación de contraseñas</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->SMTPDebug = 2;
        $mail->send();

        header("Location: ../pages/recuperar_contraseña_finalizar.php");
        exit(); // Detener la ejecución
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header("Location: ../pages/recuperar_contraseña.php?error=No se encontro el correo electronico");
    exit(); // Detener la ejecución
}
