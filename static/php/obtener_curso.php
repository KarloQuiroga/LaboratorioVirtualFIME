<?php
include "conexion.php";

$editId = $_POST['id']; 

$sql = "SELECT C_Brigada, C_Estado FROM curso where ID_Curso = $editId";

$resultados = mysqli_query($conexion, $sql);
$laboratorios = array();

if ($resultados) {
    while ($row = mysqli_fetch_assoc($resultados)) {
        $laboratorios[] = $row;
    }
    echo json_encode($laboratorios);
} else {
    echo json_encode(array()); // Devuelve un arreglo vacío si no se encuentran resultados
}
?>
