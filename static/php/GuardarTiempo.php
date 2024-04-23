<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datosJSON = $_POST['datos'];
        header('Content-Type: application/json');
        if (!empty($datosJSON)) {
            $datos = json_decode($datosJSON, true);
            if (!empty($datos['Inicio']) && !empty($datos['Final']) && !empty($datos['Reservacion'])) {
                $Ingreso = $datos['Inicio'];
                $Salida = $datos['Final'];
                $ID = $datos['Reservacion'];
                $Respuesta = RegistrarActividad($Ingreso,$Salida,$ID);
                echo json_encode($Respuesta);
            }  else {
                echo json_encode(array("Titulo" => "¡Error!","mensaje" => "No se recibieron todas las variables requeridas."));
            }
        } else {
            echo json_encode(array("Titulo" => "¡Error!", "mensaje" => "No se recibieron datos JSON válidos."));
        }
    } else {
        echo json_encode(array("Titulo" => "¡Error!", "mensaje" => "Solicitud no válida."));
    }


    function RegistrarActividad($Inicio,$Final,$Reservacion){ //Valida si el dia y la fecha en la que se hace reservacion se sobrepone sobre otra reservacion ya hecha
        include "conexion.php";
        include "controlador_sesion_alumno.php";
        mysqli_query($conexion,"INSERT into estudianteactividad (ref_estudiante,ref_reservacion,ea_ingreso,ea_salida) values ($Usuario,$Reservacion,'$Inicio','$Final')");
        return array("Titulo" => "¡Exito!", "mensaje" => "Tiempo actualizado.");
    }
?>