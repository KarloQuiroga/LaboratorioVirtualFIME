<?php // Recibe la información del formulario
include "controlador_sesion_admin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    post_importar_csv();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location:../../templates/a_alumnos.php");
}

function post_importar_csv()
  {
    try {
 
      $rows     = [];
      $total    = 0;
      $inserted = 0;
      $errors   = 0;
      if (!isset($_FILES["archivo"]) && !isset($_POST["addId"])) {
        throw new Exception("Selecciona un archivo CSV válido.");
      }
 
      $file     = $_FILES["archivo"];
      $tmp      = $file["tmp_name"];
      $filename = $file["name"];
      $size     = $file["size"];
      $Curso = $_POST["addId"];

      if (pathinfo($filename, PATHINFO_EXTENSION) !== 'csv') {
        throw new Exception("Selecciona un archivo válido por favor.");
      }
      if ($size < 0) {
        throw new Exception("Selecciona un archivo válido por favor.");
      }
 
      $handle = fopen($tmp, "r");
      $delimitadorDetectado = detectarDelimitador($tmp);
      if ($delimitadorDetectado === null) {
        throw new Exception("No se pudo detectar el delimitador.");
      }

      while (($data = fgetcsv($handle,0,$delimitadorDetectado)) !== false) {
        $rows[] = $data;
      }
 
      unset($rows[0]); // se eliminan las cabeceras
      $total = count($rows);
       
      if ($total <= 0) {
        throw new Exception("El archivo proporcionado está vacio.");
      }
      $Alumnos = array();
      $Inexistente = "<br><br><strong> Alumnos inexistentes: </strong> <br>";
      $Duplicado = "<br><br><strong>Alumnos duplicados: </strong><br>";
      $Inscrito = "<br><br><strong>Alumnos inscritos: </strong><br>";
      // Insertando información
      foreach ($rows as $r) {
            $Alumnos[$r[0]]["Titulo"] = $r[0];
            $Alumnos[$r[0]]["Mensaje"] = $r[1];
            print $r[0] ."\r";
            $respuesta = Inscribir($r[0], $Curso);
            if ($respuesta == 3){
                $Inscrito .= $r[0] ." ";
            }
            elseif ($respuesta == 2){
              $Duplicado .= $r[0] ." ";
            }
            elseif ($respuesta == 1){
              $Inexistente .= $r[0] ." ";
            }
      }
      $_SESSION['Estado'] = "Resultados";
      $_SESSION['Mensaje'] = $Inexistente . $Duplicado .$Inscrito; 
      header("location:../../templates/a_alumnos_curso.php?Curso=".$Curso."&&Respuesta=1");
      if ($errors > 0) {
        echo('Tuvimos problemas al importar <b>%s</b> registros.' . $errors);
      }
 
 
    } catch (Exception $e) {
      echo ($e . 'danger');
    }
  }
  
function Inscribir($Estudiante, $Curso){
    include "conexion.php";
        $resultados = mysqli_query($conexion,"SELECT id_matricula FROM USUARIO WHERE ID_MATRICULA = $Estudiante");
        $consulta = mysqli_fetch_array($resultados);
        if($consulta) {
            include "conexion.php";
            $resultados = mysqli_query($conexion,"SELECT ref_estudiante FROM INSCRIPCION WHERE ref_estudiante = $Estudiante and ref_curso = $Curso");
            $consulta = mysqli_fetch_array($resultados);
            if($consulta){
                return 2;//"El alumno ya esta inscrito en el curso";
            }
            else{          
                    include "conexion.php";
                    $resultados = mysqli_query($conexion,"INSERT INTO INSCRIPCION VALUES ($Estudiante,$Curso)");
                    return 3;//"El alumno fue ingresdo con exito"; 
            }
        }
        else{
            return 1;//"El alumno no esta registrado en el sistema"; 
        }
}

function detectarDelimitador($archivo) {
  $delimitadores = [',', ';', '\t'];  // Coma, punto y coma, tabulación

  foreach ($delimitadores as $delimitador) {
      $handle = fopen($archivo, 'r');
      $linea = fgetcsv($handle, 0, $delimitador);
      fclose($handle);

      if ($linea !== false && count($linea) > 1) {
          return $delimitador;
      }
  }

  return false;  // No se pudo detectar el delimitador
}

  ?>