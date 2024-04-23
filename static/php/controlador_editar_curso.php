<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLab= $_POST["addId2"];
    $idCur= $_POST["editId"];
    $brigada = $_POST["C_Brigada"];
    $estado = $_POST["Estado"];

    $query = "UPDATE Curso SET
              C_Brigada = '$brigada',
              C_Estado = '$estado'
              WHERE ID_Curso = $idCur";

    if (mysqli_query($conexion, $query)) {
        echo "Curso modificado con éxito.";
        header("location:../../templates/a_cursos.php?Lab=" . $idLab);
    } else {
        echo "Error en la actualización: " . mysqli_error($conexion);
    }
} else {
    echo "Solicitud no válida";
}
?>
