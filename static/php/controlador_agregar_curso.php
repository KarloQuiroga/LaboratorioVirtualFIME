<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addId'], $_POST['C_Brigada'])) {
        // Obtén los valores del formulario
        $refLaboratorio = $_POST['addId'];
        $brigada = $_POST['C_Brigada'];
        $estado = 1;

        // Prepara la consulta SQL para insertar el curso en la base de datos
        $sql = "INSERT INTO Curso (ref_Laboratorio, C_Brigada, C_Estado) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Vincula los parámetros
            $stmt->bind_param("iis", $refLaboratorio, $brigada, $estado);

            // Ejecuta la consulta SQL
            if ($stmt->execute()) {
                echo "Curso agregado con éxito.";
                header("location:../../templates/a_cursos.php?Lab=" . $refLaboratorio);
                exit;
            } else {
                echo "Error al agregar el curso: " . $stmt->error;
            }

            // Cierra la declaración
            $stmt->close();
        } else {
            // Error en la preparación de la consulta
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        echo "Faltan datos del formulario.";
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
