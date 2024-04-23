<?php
include "conexion.php";
include "controlador_sesion_admin.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $idMatricula = $_POST["editId"];
    $tipo = $_POST["U_Rol"];
    $estado = $_POST["U_Estado"];
    $correo = $_POST["U_Correo"];
    $nombre = $_POST["U_Nombre"];
    $apellidos = $_POST["U_Apellido"];
    $password = $_POST["U_Clave"];

      // Validar que el correo electrónico tenga un formato específico
      if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || !strpos($correo, '@uanl.edu.mx')) {
        echo "El formato del correo electrónico no es válido o no pertenece a uanl.edu.mx.";
        exit;
    }

    // Realiza la actualización en la base de datos
    $query = "UPDATE usuario SET
              U_Nombre = '$nombre',
              U_Apellido = '$apellidos',
              U_Clave = '$password',
              U_Correo = '$correo',
              U_Rol = '$tipo',
              U_Estado = '$estado'
              WHERE ID_Matricula = $idMatricula";

    if (mysqli_query($conexion, $query)) {
        header("location:../../templates/a_alumnos.php");
        $_SESSION['Mensaje'] = "Usuario modificado con éxito.";
    } else {
        $_SESSION['Mensaje'] = "Error al modificar este usuario: " . mysqli_error($conexion);
    }
} else {
    $_SESSION['Mensaje'] = "Solicitud no válida";
}
?>
