<?php
include "conexion.php";

if (isset($_POST["password"])) {
    $correo = $_POST["Correo"];

    $consulta_usuario = "SELECT * FROM usuario WHERE U_Correo = '$correo'";
    $resultado = $conexion->query($consulta_usuario);

    // Verificar si se encontró un usuario con ese correo
    if ($resultado->num_rows > 0) {
        $token = uniqid();

        // Guardar el token y el correo en la tabla tokens_recuperacion
        $consulta_token = "INSERT INTO tokens_recuperacion (T_Correo, T_Token) VALUES ('$correo', '$token')";
        $conexion->query($consulta_token);

        $conexion->close();
        
        header("location:controlador_olvide_password_correo.php?&correo=$correo&token=$token");
        exit;
    } else {
        //header("location:../../templates/olvidepassword.php?Respuesta=1");
        echo "No se encontró ningún usuario con ese correo electrónico.";
    }
}
?>
