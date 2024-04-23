<?php
// Incluye el archivo de conexión a la base de datos
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editId'])) {
        // Sanitiza el ID para prevenir inyección de SQL
        $idAEliminar = filter_var($_POST['editId'], FILTER_SANITIZE_NUMBER_INT);

        // Prepara la consulta SQL para eliminar la práctica
        $query = "DELETE FROM practica WHERE P_Practica = ?";
        $stmt = $conexion->prepare($query);

        if ($stmt) {
            // Vincula el ID de la práctica a eliminar
            $stmt->bind_param("i", $idAEliminar);

            // Ejecuta la consulta SQL
            if ($stmt->execute()) {
                echo "Práctica eliminada con éxito";
            } else {
                echo "Error al eliminar la práctica: " . $stmt->error;
            }

            // Cierra la declaración
            $stmt->close();
        } else {
            // Error en la preparación de la consulta
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        echo "ID de práctica no proporcionado";
    }
} else {
    echo "Solicitud no válida";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
