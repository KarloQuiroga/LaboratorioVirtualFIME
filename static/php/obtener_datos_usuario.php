<?php
include "conexion.php";

$editId = $_POST['id']; // Obtén el valor de 'id' del POST

$query = "SELECT * FROM usuario WHERE ID_Matricula = $editId";
$result = mysqli_query($conexion, $query);

if ($result) {
    $userData = mysqli_fetch_assoc($result);
    echo json_encode($userData); // Devuelve un JSON válido
} else {
    $error = array('error' => 'No se encontraron datos');
    echo json_encode($error); // Devuelve un JSON válido
}
?>
