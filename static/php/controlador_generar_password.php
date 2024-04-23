<?php
$dir_actual = __DIR__;

require_once $dir_actual . '/phpmailer/Exception.php';
require_once $dir_actual . '/phpmailer/PHPMailer.php';
require_once $dir_actual . '/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function Mailto($correo, $password){
try {
    // Configuración del servidor
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'laboratoriovirtualfime@gmail.com';
    $mail->Password   = 'xuzzhfopzzdpiriw';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('laboratoriovirtualfime@gmail.com', 'LaboratorioVirtualFime');
    $mail->addAddress($correo);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Registro dado de alta - Credenciales de acceso';
    $mail->Body = "
        <p>Su usuario ha sido dado de alta. Bienvenido a la plataforma Fime Virtual</p>
        <p><a>Sus credenciales de acceso son:</a></p>
        <p><a>Correo: $correo</a></p>
        <p><a>Contraseña generada: $password</a></p>
        <p>Este es un correo automatizado y no está configurado para recibir respuestas. Si tiene alguna pregunta o necesita asistencia, por favor contacte al equipo de soporte a través de los canales correspondientes. Gracias.</p>
    ";
    $mail->CharSet = 'UTF-8';
    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}
}
?>
