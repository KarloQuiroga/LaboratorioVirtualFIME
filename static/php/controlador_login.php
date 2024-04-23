<?php
session_start();
function LaboratoriosEnCurso($Estudiante){
    include "conexion.php";
    $resultados = mysqli_query($conexion,"select c.C_Estado from curso c, inscripcion i  WHERE 	c.ID_Curso = i.ref_Curso AND i.ref_Estudiante = $Estudiante AND c.C_Estado = 1");
    $consulta = mysqli_fetch_array($resultados);
    if($consulta) {
      return true;
    }
    else{
      return false; 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosJSON = $_POST['datos'];
    header('Content-Type: application/json');
    if (!empty($datosJSON)) {
        $datos = json_decode($datosJSON, true);
        if (!empty($datos['Matricula']) && !empty($datos['Clave']) && !empty($datos['Rol'])) {
            $ID = $datos['Matricula'];
            $Clave = $datos['Clave'];
            if ($datos['Rol'] == 'Alumno') {
                include "conexion.php";    
                $sql = $conexion->query("SELECT * FROM usuario WHERE U_Correo='$ID' AND U_Clave='$Clave' AND U_Rol=1");
                if ($datos = $sql->fetch_object()) {
                    if ($datos->U_Estado == 1) {
                        $Estudiante = $datos->ID_Matricula;
                        $Valor = LaboratoriosEnCurso($Estudiante);
                        if($Valor !== false){
                        $_SESSION["Matricula"] = $datos->ID_Matricula;
                        $_SESSION["Nombre"] = $datos->U_Nombre;
                        $_SESSION["Apellido"] = $datos->U_Apellido;
                        $_SESSION["Correo"] = $datos->U_Correo;
                        $_SESSION["Rol"] = "Alumno";
                        echo json_encode(array("Titulo" => "¡Exito!","redirect_url" => "templates/laboratorios.php"));
                        }
                        else{
                        echo json_encode(array("Titulo" => "¡Error!","mensaje" => "El alumno no tiene laboratorios activos"));
                        }
                    } else {
                        echo json_encode(array("Titulo" => "¡Error!","mensaje" => "Acceso denegado (Solicite que de de alta su usuario)."));
                    }
                } else {
                    echo json_encode(array("Titulo" => "¡Error!","mensaje" => "Acceso denegado (credenciales incorrectas)."));
                }
            } 
            elseif ($datos['Rol'] == 'Empleado') {
                include "conexion.php";    
                $sql = $conexion->query("SELECT * FROM usuario WHERE U_Correo='$ID' AND U_Clave='$Clave' AND U_Rol=2");
                if ($datos = $sql->fetch_object()) {
                    if ($datos->U_Estado == 1) {
                        $_SESSION["Matricula"] = $datos->ID_Matricula;
                        $_SESSION["Nombre"] = $datos->U_Nombre;
                        $_SESSION["Apellido"] = $datos->U_Apellido;
                        $_SESSION["Correo"] = $datos->U_Correo;
                        $_SESSION["Rol"] = "Administrador";
                        echo json_encode(array("Titulo" => "¡Exito!","redirect_url" => "templates/a_reservaciones.php"));
                    } else {
                        echo json_encode(array("Titulo" => "¡Error!","mensaje" => "Acceso denegado (Solicite que de de alta su usuario)."));
                    }
                } else {
                    echo json_encode(array("Titulo" => "¡Error!","mensaje" => "Acceso denegado (credenciales incorrectas)."));
                }
            }
            else {
                echo json_encode(array("Titulo" => "¡Error!","mensaje" => "Acceso denegado (credenciales incorrectas)."));
            }
        }  else {
            echo json_encode(array("Titulo" => "¡Error!","mensaje" => "No se recibieron todas las variables requeridas."));
        }
    } else {
        echo json_encode(array("Titulo" => "¡Error!", "mensaje" => "No se recibieron datos JSON válidos."));
    }
} else {
    echo json_encode(array("Titulo" => "¡Error!", "mensaje" => "Solicitud no válida."));
}

?>
