<?php
include "controlador_sesion_admin.php";
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['L_Nombre'], $_POST['Estado'], $_POST['L_Periodo'],$_POST['editId'], $_POST['L_FechaInicio'], $_POST['L_Fechafin'])) {
        // Obtén los datos del formulario
        $nombre = $_POST['L_Nombre'];
        $estado = $_POST['Estado'];
        $periodo = $_POST['L_Periodo'];
        $fechaInicio = $_POST['L_FechaInicio'];
        $fechaFin = $_POST['L_Fechafin'];
        $id = $_POST['editId'];
        // Realiza la actualización en la base de datos
        $query = "UPDATE laboratorio SET
                    L_Nombre = '$nombre',
                    L_Periodo = '$periodo',
                    L_FechaInicio = '$fechaInicio',
                    L_Fechafin = '$fechaFin',
                    L_Estado = '$estado'
                    WHERE ID_Laboratorio = $id";

        if (mysqli_query($conexion, $query)) {

            $_SESSION['Mensaje'] = "Laboratorio modificado con éxito.";
        } else {
            $_SESSION['Mensaje'] = "Error en la actualización: " . mysqli_error($conexion);
        }
    } else {
        $_SESSION['Mensaje'] = "Faltan datos del formulario.";
    }
    header("location:../../templates/a_laboratorios.php?Respuesta=1");
} 
?>