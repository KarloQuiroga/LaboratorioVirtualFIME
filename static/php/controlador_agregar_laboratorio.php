<?php
include "conexion.php";
include "controlador_sesion_admin.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location:../../templates/a_alumnos.php");
}

$_SESSION['Estado'] = "¡Error!";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['L_Nombre'], $_POST['L_Periodo'], $_POST['L_FechaInicio'], $_POST['L_FechaFin'])) {
        
        // Obtiene los valores del formulario
        $nombre = $_POST['L_Nombre'];
        $periodo = $_POST['L_Periodo'];
        $fechaInicio = $_POST['L_FechaInicio'];
        $fechaFin = $_POST['L_FechaFin'];
        $estado = 1; // Aquí se asigna el valor 1 a L_Estado

        // Prepara la consulta SQL para insertar el laboratorio en la base de datos
        $sql = "INSERT INTO laboratorio (L_Nombre, L_Periodo, L_FechaInicio, L_FechaFin, L_Estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Vincula los parámetros
            $stmt->bind_param("ssssi", $nombre, $periodo, $fechaInicio, $fechaFin, $estado);

            // Ejecuta la consulta SQL
            if ($stmt->execute()) {
                $_SESSION['Estado'] = "¡Exito!";
                $_SESSION['Mensaje'] = "Laboratorio agregado con éxito.";
            } else {
                $_SESSION['Mensaje'] ="Error al agregar el laboratorio: " . $stmt->error;
            }

            // Cierra la declaración
            $stmt->close();
        } else {
            // Error en la preparación de la consulta
            $_SESSION['Mensaje']= "Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        $_SESSION['Mensaje'] = "Faltan datos del formulario.";
    }
    header("location:../../templates/a_laboratorios.php?Respuesta=1");
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
