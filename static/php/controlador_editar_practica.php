<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los valores del formulario
    $id = $_POST['editId'];
    $lab = $_POST['lab'];
    $nombre = $_POST['P_Nombre'];
    $descripcion = $_POST['P_Descripcion'];
    $tiempo = $_POST['P_Tiempo'];
    $estado = $_POST['Estado'];
    $IFecha = $_POST['P_FechaInicio'];
    $OFecha = $_POST['P_FechaFin'];

    // Prepara la consulta SQL para actualizar la práctica en la base de datos
    $sql = "UPDATE Practica SET P_Nombre = ?, P_Descripcion = ?, P_Tiempo = ?, P_Estado = ?, P_FechaInicio = ?, P_FechaFin = ?  WHERE ID_Practica = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        // Vincula los parámetros
        $stmt->bind_param("ssssssi", $nombre, $descripcion, $tiempo, $estado, $IFecha, $OFecha, $id);

        // Ejecuta la consulta SQL
        if ($stmt->execute()) {
            echo "Práctica modificada con éxito.";
            header("location:../../templates/a_practica.php?Lab=" . $lab);
            exit;
        } else {
            echo "Error en la actualización: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    } else {
        // Error en la preparación de la consulta
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
} else {
    echo "Solicitud no válida";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
