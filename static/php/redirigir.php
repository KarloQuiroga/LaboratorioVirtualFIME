<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosJSON = $_POST['datos'];
    header('Content-Type: application/json');
    if (!empty($datosJSON)) {
        $datos = json_decode($datosJSON, true);
        if (isset($datos['Tipo'])) {
            $Clase = $datos['Tipo'];
            if ($Clase == "Simular"){
                $respuesta = array("redirect_url" => "simulador.php?Res=". $datos['Reservacion']);
            }
            if ($Clase == "Laboratorio"){
                $respuesta = array("redirect_url" => "repositoriopracticas.php?Lab=" . $datos['Lab']);
            }
            if ($Clase == "a_Laboratorio"){
                $respuesta = array("redirect_url" => "a_practica.php?Lab=" . $datos['Lab']);
            }
            if ($Clase == "a_Cursos"){
                $respuesta = array("redirect_url" => "a_cursos.php?Lab=" . $datos['Lab']);
            }
            if ($Clase == "a_Cursos_Alumnos"){
                $respuesta = array("redirect_url" => "a_alumnos_curso.php?Curso=" . $datos['Lab']);
            }
            if ($Clase == "Practica"){
                $respuesta = array("redirect_url" => "reservarpractica.php?Lab=" . $datos['Test'] . "&Práctica=" . $datos['Lab']);
            }
            if ($Clase == "Reservacion"){
                include "conexion.php";
                $Reservacion = $datos['Reservacion'];
                mysqli_query($conexion,"update Reservacion set R_Estado = 2 where ID_Reservacion=($Reservacion)");
                $respuesta = (array("Titulo" => "Exito", "mensaje" => "Reservacion eliminada."));
            }
            header('Content-Type: application/json');
            echo json_encode($respuesta);
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