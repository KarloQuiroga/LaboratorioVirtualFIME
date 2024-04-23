<?php
include("conexion.php");

if (isset($_FILES['archivo_csv']) && $_FILES['archivo_csv']['error'] === UPLOAD_ERR_OK) {
    $archivo_temporal = $_FILES['archivo_csv']['tmp_name'];
    $nombre_archivo = $_FILES['archivo_csv']['name'];

    if (pathinfo($nombre_archivo, PATHINFO_EXTENSION) == 'csv') {

        $tabla = "usuario"; // Nombre de la tabla donde se insertarán los datos

        $query = "LOAD DATA LOCAL INFILE '$archivo_temporal' INTO TABLE $tabla
                  FIELDS TERMINATED BY ',' 
                  LINES TERMINATED BY '\\n' 
                  IGNORE 1 LINES"; // Cambia el delimitador y otras opciones según tu archivo CSV

        if ($conexion->query($query) === TRUE) {
            echo "Archivo CSV subido y datos insertados en la base de datos correctamente.";
        } else {
            echo "Error al cargar el archivo CSV: " . $conexion->error;
        }

        $conexion->close();
    } else {
        echo "El archivo no es de tipo CSV.";
    }
} else {
    echo "No se seleccionó un archivo válido.";
}
?>
