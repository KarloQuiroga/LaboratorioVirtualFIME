<?php
include "conexion.php";
include "controlador_sesion_admin.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location:../../templates/a_alumnos.php");
}

$_SESSION['Estado'] = "¡Error!";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ref_laboratorio'], $_POST['P_Numero'], $_POST['P_Nombre'], $_POST['P_Descripcion'], $_POST['P_Tiempo'], $_POST['P_FechaInicio'], $_POST['P_FechaFin'])) {
        // Obtén los valores del formulario
        $numero = $_POST['P_Numero'];
        $refLaboratorio = $_POST['ref_laboratorio'];
        $nombre = $_POST['P_Nombre'];
        $descripcion = $_POST['P_Descripcion'];
        $tiempo = $_POST['P_Tiempo'];
        $fechaInicio = $_POST['P_FechaInicio'];
        $fechaFin = $_POST['P_FechaFin'];
        $edo = 1;   
        $Resultado = ExistePractica($numero, $refLaboratorio);
        if ($Resultado){
            $sql = "INSERT INTO Practica (P_Numero, ref_laboratorio, P_Nombre, P_Descripcion, P_Tiempo, P_FechaInicio, P_FechaFin, P_Estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);            
            if ($stmt) {
                // Vincula los parámetros
                $stmt->bind_param("issssssi", $numero, $refLaboratorio, $nombre, $descripcion, $tiempo, $fechaInicio, $fechaFin, $edo);

                // Ejecuta la consulta SQL
                if ($stmt->execute()) {
                    $_SESSION['Estado'] = "¡Exito!";
                    $_SESSION['Mensaje'] = "Practica agregada con éxito.";
                } else {
                    $_SESSION['Mensaje'] = "Error al agregar practica: " . $stmt->error;
                }

                // Cierra la declaración
                $stmt->close();
            } else {
                // Error en la preparación de la consulta
                $_SESSION['Mensaje'] = "Error en la preparacion de la consulta: " . $conexion->error;
            }
        }
        // Prepara la consulta SQL para insertar la práctica en la base de datos        
    } else {
        $_SESSION['Mensaje'] = "Faltan datos del formulario ";
    }
    header("location:../../templates/a_practica.php?Lab=". $refLaboratorio . "&&Respuesta=1");

}


function ExistePractica($Test, $Lab){
    include "conexion.php";
    $consulta_existencia = "SELECT P_Numero FROM Practica WHERE P_Numero = ? and ref_Laboratorio = ?";
    $stmt_existencia = $conexion->prepare($consulta_existencia);
    $stmt_existencia->bind_param("ii", $Test,$Lab);
    $stmt_existencia->execute();
    $stmt_existencia->store_result();
    if ($stmt_existencia->num_rows > 0) {
        $_SESSION['Mensaje'] = "El número de práctica ya existe.";
        $stmt_existencia->close();
        $conexion->close();
        return false;
    }
    else{
        return true;
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
