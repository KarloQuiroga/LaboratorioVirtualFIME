<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosJSON = $_POST['datos'];
    header('Content-Type: application/json');
    if (!empty($datosJSON)) {
        $datos = json_decode($datosJSON, true);
        if (isset($datos['Estudiante']) && isset($datos['Curso'])) {
            $Estudiante = $datos['Estudiante'];
            $Curso = $datos['Curso'];
            include "conexion.php";
            mysqli_query($conexion,"DELETE FROM INSCRIPCION WHERE ref_estudiante = $Estudiante and ref_curso = $Curso");
            echo json_encode(array("mensaje" => "Bien"));

        } else {
            echo json_encode(array("mensaje" => "No se recibieron todas las variables requeridas."));
        }
    } else {
        echo json_encode(array("mensaje" => "No se recibieron datos JSON válidos."));
    }
} else {
    echo json_encode(array("mensaje" => "Solicitud no válida."));
}
?>