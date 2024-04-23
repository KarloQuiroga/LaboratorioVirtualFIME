<?php
include "conexion.php";

$sql = "SELECT ID_Laboratorio, L_Nombre FROM Laboratorio";

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
