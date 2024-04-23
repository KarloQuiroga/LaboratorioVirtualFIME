<?php
$dir_actual = __DIR__;

require_once $dir_actual . '/phpmailer/Exception.php';
require_once $dir_actual . '/phpmailer/PHPMailer.php';
require_once $dir_actual . '/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$correo = isset($_GET["correo"]) ? urldecode($_GET["correo"]) : "";
$token = isset($_GET["token"]) ? urldecode($_GET["token"]) : "";
$enlace_cambio_password = "http://localhost/mechalabv8/templates/cambiar_password.php?correo={$correo}&token={$token}";

//Crea una instancia que si pasa activa las exepcions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'laboratoriovirtualfime@gmail.com';                     //SMTP username
    $mail->Password   = 'xuzzhfopzzdpiriw';                               //SMTP password
    $mail->SMTPSecure = 'tls';                                  //Cambiar a SSL cuando se tenga el certificado.
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('laboratoriovirtualfime@gmail.com', 'LaboratorioVirtualFime');
    $mail->addAddress($correo);

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Cambio de acceso a cuenta';
    $mail->Body = "
                    <p>Has solicitado un cambio de contraseña. Haz clic en el siguiente enlace para cambiar tu contraseña:</p>
                    <p><a href='$enlace_cambio_password'>Cambiar Contraseña</a></p>
                    <p><a'>Si no funciona al presionar puedes entrar al siguiente vínculo: $enlace_cambio_password</a></p>
                    <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>
                ";
                
    $mail->CharSet = 'UTF-8';
    $mail->send();

    header("location:../../index.php");
    echo 'Contrasena cambiada';
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}