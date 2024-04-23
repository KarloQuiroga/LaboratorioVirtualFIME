<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario y asegurarse de que estén definidos
    if (isset($_POST["U_Matricula"]) && isset($_POST["addId"])) {
        $Estudiante = $_POST["U_Matricula"];
        $Curso = $_POST["addId"];
        include "conexion.php";
        $resultados = mysqli_query($conexion,"SELECT id_matricula FROM USUARIO WHERE ID_MATRICULA = $Estudiante");
        $consulta = mysqli_fetch_array($resultados);
        if($consulta) {
            include "conexion.php";
            $resultados = mysqli_query($conexion,"SELECT ref_estudiante FROM INSCRIPCION WHERE ref_estudiante = $Estudiante and ref_curso = $Curso");
            $consulta = mysqli_fetch_array($resultados);
            if($consulta){
                echo "El usuario ya esta inscrito";
            }
            else{          
                    include "conexion.php";
                    $resultados = mysqli_query($conexion,"INSERT INTO INSCRIPCION VALUES ($Estudiante,$Curso)");
                    header("location:../../templates/a_alumnos_curso.php?Curso=".$Curso);
            }
        }
        else{
            echo "El usuario ingresado no existe"; 
        }
         
    } else {
        echo "Faltan datos del formulario.";
    }
    $conexion->close(); // Cierra la conexión aquí en caso de que falten datos o haya un error.
}
?>
