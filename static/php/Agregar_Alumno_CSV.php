<?php
// Recibe la información del formulario
include "controlador_sesion_admin.php";

$_SESSION['Estado'] = "¡Error!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    post_importar_csv();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location:../../templates/a_alumnos.php");
}

function Salir()
{
    header("location:../../templates/a_alumnos.php?Respuesta=1");
    exit;
}

function post_importar_csv()
{
    try {
        $rows = [];
        $total = 0;

        if (!isset($_FILES["archivo"])) {
            throw new Exception("Selecciona un archivo CSV válido.");
        }

        $file = $_FILES["archivo"];
        $tmp = $file["tmp_name"];
        $filename = $file["name"];
        $size = $file["size"];

        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'csv') {
            $_SESSION['Mensaje'] = "Selecciona un archivo válido por favor.";
            Salir();
        }

        if ($size < 0) {
            $_SESSION['Mensaje'] = "Selecciona un archivo válido por favor.";
            Salir();
        }

        $handle = fopen($tmp, "r");
        $delimitadorDetectado = detectarDelimitador($tmp);

        if ($delimitadorDetectado === null) {
            $_SESSION['Mensaje'] = "No se pudo detectar el delimitador.";
            Salir();
        }

        if (($gestor = fopen($tmp, 'r')) !== false) {
            $encabezados = fgetcsv($gestor, 0, $delimitadorDetectado);
            fclose($gestor);
            if ($encabezados !== false) {
                $numero_de_columnas = count($encabezados);
            }
            if($numero_de_columnas != 4){
                echo "hola" .$numero_de_columnas;
                $_SESSION['Mensaje'] = "Los parámetros de los datos proporcionados no son válidos." .$numero_de_columnas;
                Salir();
            }
        }
        while (($data = fgetcsv($handle, 0, $delimitadorDetectado)) !== false) {
            $rows[] = $data;
        }


        unset($rows[0]); // se eliminan las cabeceras
        $total = count($rows);

        if ($total < 0) {
            $_SESSION['Mensaje'] = "El archivo proporcionado está vacío.";
            Salir();
        }


        $Alumnos = array();
        $Registrado = "<br><br><strong> Alumnos registrados: </strong> <br>";
        $Duplicado = "<br><br><strong>Alumnos duplicados: </strong><br>";
        $Invalido = "<br><br><strong>Alumnos con correo no valido: </strong><br>";
        // Insertando información
        // La columna 0 son matrículas, la uno es el nombre, la dos es el apellido y la tres es el correo
        foreach ($rows as $r) {
            print $r[0] . "\r";
            $respuesta = Registrar($r[0], $r[1], $r[2], $r[3]);

            if ($respuesta == 1) {
                $Registrado .= $r[0] . " ";
            } elseif ($respuesta == 2) {
                $Duplicado .= $r[0] . " ";
            } elseif ($respuesta == 3) {
                $Invalido .= $r[0] ." ";
            }
        }

        $_SESSION['Estado'] = "Resultados";
        $_SESSION['Mensaje'] = $Registrado . $Duplicado . $Invalido;
        Salir();
    } catch (Exception $e) {
        echo ($e . 'danger');
    }
}

function Registrar($Estudiante, $Nombre, $Apellido, $Correo)
{
    include "conexion.php";

    if (!filter_var($Correo, FILTER_VALIDATE_EMAIL) || strpos($Correo, '@uanl.edu.mx') === false) {
        return 3; // Correo no válido
    }

    $resultados = mysqli_query($conexion, "SELECT id_matricula FROM USUARIO WHERE ID_MATRICULA = " . mysqli_real_escape_string($conexion, $Estudiante));
    $consulta = mysqli_fetch_array($resultados);

    if ($consulta) {
        return 2; // El alumno ya estaba registrado
    } else {
        $clave = generarpassword(); // Utiliza la función generarpassword para generar la contraseña
        $claveEscapada = mysqli_real_escape_string($conexion, $clave);
        mysqli_query($conexion, "INSERT INTO Usuario values ($Estudiante,'$Nombre','$Apellido','$claveEscapada','$Correo',1,1)");
        EnviarPSW($Correo, $clave);
        return 1; // El alumno se registró en el sistema
    }
}

function EnviarPSW($Correo, $clave)
{
    include_once "controlador_generar_password.php";
    Mailto($Correo, $clave);
}


function generarpassword()
{
    $longitud = 10; // Longitud de la contraseña
    $clave = bin2hex(random_bytes($longitud));
    return $clave;
}


function detectarDelimitador($archivo)
{
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
