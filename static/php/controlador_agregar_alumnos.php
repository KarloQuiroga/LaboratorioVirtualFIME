<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario y asegurarse de que estén definidos
    if (isset($_POST["Tipo"]) && isset($_POST["Estado"]) && isset($_POST["U_Nombre"]) &&
        isset($_POST["U_Apellido"]) && isset($_POST["U_Clave"]) && isset($_POST["U_Correo"]) &&
        isset($_POST["U_Matricula"]) && isset($_POST["E_PasswordCopy"])) {

        $tipo = ($_POST["Tipo"] == "Alumno") ? 1 : 2; // 1 para Alumno, 2 para Docente
        $estado = ($_POST["Estado"] == "Activo") ? 1 : 0;
        $nombre = $_POST["U_Nombre"];
        $apellido = $_POST["U_Apellido"];
        $password = $_POST["U_Clave"];
        $correo = $_POST["U_Correo"];
        $Matricula = $_POST["U_Matricula"];

        // Validar que las contraseñas coincidan
        $passwordCopy = $_POST["E_PasswordCopy"];
        if ($password != $passwordCopy) {
            echo "Las contraseñas no coinciden.";
            exit;
        }

        // Validar que el correo electrónico tenga un formato específico
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || !strpos($correo, '@uanl.edu.mx')) {
            echo "El formato del correo electrónico no es válido o no pertenece a uanl.edu.mx.";
            exit;
        }

        // Crear una consulta SQL para insertar el usuario en la base de datos
        $sql = "INSERT INTO usuario (ID_Matricula, U_Nombre, U_Apellido, U_Clave, U_Correo, U_Rol, U_Estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssss", $Matricula, $nombre, $apellido, $password, $correo, $tipo, $estado);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Usuario agregado con éxito.";
            header("location:../../templates/a_alumnos.php");
            exit;
        } else {
            echo "Error al agregar el Usuario: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
    } else {
        echo "Faltan datos del formulario.";
    }
    $conexion->close(); // Cierra la conexión aquí en caso de que falten datos o haya un error.
}
?>
