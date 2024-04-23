<?php
include "conexion.php";

$editId = $_POST['id']; // Obtén el valor de 'id' del POST

$query = "SELECT * FROM practica WHERE ID_Practica = $editId";
$result = mysqli_query($conexion, $query);

if ($result) {
    $practicaData = mysqli_fetch_assoc($result);
    echo json_encode($practicaData); // Devuelve un JSON válido con los datos de la práctica
} else {
    $error = array('error' => 'No se encontraron datos');
    echo json_encode($error); // Devuelve un JSON válido con un mensaje de error
}
?>
