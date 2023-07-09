<?php

include('../conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$email = $_POST['email'];



$consulta = "SELECT * FROM usuarios where Correo = '$email'";
$resultado = mysqli_query($enlace, $consulta);

$row = mysqli_fetch_assoc($resultado);



if ($row > 0) {

    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.ionos.mx';  
        $mail->SMTPAuth = true; 
        $mail->Username = 'support@sacnej.com';
        $mail->Password = 'Y0ohg-sOth0Th_';
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('support@sacnej.com', 'Soporte');
        $mail->addAddress($email);   //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperar Password';
        $mail->Body    = '<center>Este es un correo generado automáticamente para restablecer la contraseña de su cuenta.<br><b>Por favor, visite la página <a href="http://campolimpiojal.com/loggin/changepsw.php?id=' . $row['IdUsuario'] . '"> Sistema de trazabilidad </a></b></center>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        header("Location: ../index.php?message=ok");
    } catch (Exception $e) {
        header("Location: ../index.php?message=error");
    }
} else {
    header("Location: ../index.php?message=notfound");
}
