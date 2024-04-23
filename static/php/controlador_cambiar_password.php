<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clave = $_POST["U_Clave"];
    $clavecopia = $_POST["U_Clavecopia"];
    $correo = $_POST["correo"];
    $token = $_POST["token"];

    if ($clave === $clavecopia) {
        // Validar el token y el correo en la base de datos
        $consulta_validar_token = "SELECT * FROM tokens_recuperacion WHERE T_Correo = ? AND T_Token = ?";
        $stmt_validar_token = $conexion->prepare($consulta_validar_token);
        $stmt_validar_token->bind_param("ss", $correo, $token);
        $stmt_validar_token->execute();
        $resultado_validar_token = $stmt_validar_token->get_result();

        if ($resultado_validar_token->num_rows > 0) {
            // Token y correo válidos, permitir al usuario cambiar la contraseña
            $consulta_actualizar_contrasena = "UPDATE usuario SET U_Clave = ? WHERE U_Correo = ?";
            $stmt_actualizar_contrasena = $conexion->prepare($consulta_actualizar_contrasena);
            $stmt_actualizar_contrasena->bind_param("ss", $clave, $correo);
            $stmt_actualizar_contrasena->execute();

            // Eliminar el token de recuperación
            $consulta_eliminar_token = "DELETE FROM tokens_recuperacion WHERE T_Correo = ? AND T_Token = ?";
            $stmt_eliminar_token = $conexion->prepare($consulta_eliminar_token);
            $stmt_eliminar_token->bind_param("ss", $correo, $token);
            $stmt_eliminar_token->execute();
            //$_SESSION['Mensaje'] = "Contraseña cambiada con éxito.";
            echo "Contrasena cambiada con exito";
        } else {
            //$_SESSION['Mensaje'] = "Token no válido.";
            echo "Token no valido";
        }
    } else {
       // $_SESSION['Mensaje'] = "Token no válido.";
       echo "Token no valido";
    }
    header("location:../../index.php");
}

$conexion->close();
?>
