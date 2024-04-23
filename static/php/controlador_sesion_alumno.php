<?php
session_start();

// Verifica si la sesión está iniciada y si es un alumno
if (empty($_SESSION['Matricula'])) {
    header("location: ../index.php");
} else {
    if ($_SESSION['Rol'] != 'Alumno') {
        header("location: ../templates/a_reservaciones.php");
    } else {
        // Obtiene el tiempo de inactividad deseado en segundos
        $tiempo_inactividad = 600; // 10 minutos

        // Verifica si la marca de tiempo de la última actividad está definida
        if (isset($_SESSION['ultima_actividad']) && (time() - $_SESSION['ultima_actividad'] > $tiempo_inactividad)) {
            // Cierra la sesión si ha pasado el tiempo de inactividad
            session_unset();
            session_destroy();
            header("location: ../index.php");
            exit(); // Asegura que el script se detenga después de redireccionar
        }

        // Actualiza la marca de tiempo de la última actividad
        $_SESSION['ultima_actividad'] = time();

        $Usuario = $_SESSION['Matricula'];
    }
}
//Siempre limpiar cookies al cambiar el valor de $tiempo_inactividad.
?>
