<?php
include "controlador_sesion_alumno.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosJSON = $_POST['datos'];
    header('Content-Type: application/json');
    if (!empty($datosJSON)) {
        $datos = json_decode($datosJSON, true);
        if (!empty($datos['Fecha']) && !empty($datos['Tiempo']) && !empty($datos['Lab']) && !empty($datos['Test'])) {
            $Dia = $datos['Fecha'];
            $HInicial = $datos['Tiempo'];
            $Lab = $datos['Lab'];
            $Test = $datos['Test'];
            $Valor = ValidarHorario($HInicial, $Dia, $Lab, $Test);
            $respuesta = $Valor;
            echo json_encode($respuesta);
        }  else {
            echo json_encode(array("Titulo" => "¡Error!","mensaje" => "No se recibieron todas las variables requeridas."));
        }
    } else {
        echo json_encode(array("Titulo" => "¡Error!", "mensaje" => "No se recibieron datos JSON válidos."));
    }
} else {
    echo json_encode(array("Titulo" => "¡Error!", "mensaje" => "Solicitud no válida."));
}


function ValidarHorario($Inicio,$Fecha,$Lab,$Test){ //Valida si el dia y la fecha en la que se hace reservacion se sobrepone sobre otra reservacion ya hecha
    list($Estado, $Oportunidad) = ValidarReservacion($Lab, $Test);
    if ($Estado){
        list($Valido, $Tiempo)=ValidarVencimiento($Lab, $Test, $Fecha);
        if($Valido){
            include "conexion.php";
            $Final = CalcularFin($Inicio, $Tiempo);
            $resultados = mysqli_query($conexion,"CALL ValidarHorario('$Inicio','$Final','$Fecha')");
            $consulta = mysqli_fetch_array($resultados);
            if(empty($consulta['id'])){
                include "conexion.php";
                $Alumno = $_SESSION['Matricula'];
                mysqli_query($conexion,"insert into Reservacion (r_oportunidad,ref_estudiante,ref_laboratorio,ref_practica,r_hora,r_fecha,r_estado) values ($Oportunidad,$Alumno,$Lab,$Test,'$Inicio','$Fecha',1)");
                return array("Titulo" => "¡Exito!", "mensaje" => "La reservacion fue registrada con exito.");
            }
            else{
                return array("Titulo" => "¡Error!", "mensaje" => "Existe una reservación que choca con el horario elegido.");
            }
        }
        else{
            return $Tiempo;
        }
        
    }
    else
        return $Oportunidad;
}

function CalcularFin($Hora,$Tiempo){ // Segunda hora en formato HH:MM:SS
    // Convierte las horas a segundos
    $hora1 = new DateTime($Tiempo);
    $hora2 = new DateTime($Hora);
    // Suma las horas
    $interval = new DateInterval('PT' . $hora2->format('H') . 'H' . $hora2->format('i') . 'M' . $hora2->format('s') . 'S');
    $hora1->add($interval);
    // Convierte los segundos totales nuevamente a formato de hora
    $hora_resultado = $hora1->format('H:i:s');
    return $hora_resultado;
}

function ValidarReservacion($Lab, $Practica){
    include "conexion.php";
    $Condicion = false;
    $Estado = 0;
    $Oportunidad = 0;
    $Usuario=$_SESSION['Matricula'];
    $resultados = mysqli_query($conexion,"CALL ValidarReservacion($Usuario,$Lab,$Practica)");
    $consulta = mysqli_fetch_array($resultados);
    if(isset($consulta['r_Estado'])){
        $Estado = $consulta['r_Estado'];
        $Oportunidad = $consulta['r_oportunidad'];
    }
    if($Estado == 1){
        $Condicion = false;
        $Mensaje = array("Titulo" => "¡Error!", "mensaje" => "No puedes tener dos reservaciones activas para la misma práctica.");
    }
    elseif($Oportunidad > 1){
        $Condicion = false;
        $Mensaje = array("Titulo" => "¡Error!", "mensaje" => "Has alcanzado el limite de oportunidades para realizar esta práctica.");
    }
    else{
        $Condicion = true;
        $Oportunidad = $Oportunidad + 1;
        $Mensaje = $Oportunidad;
    }
    return array($Condicion, $Mensaje);
}

function ValidarVencimiento($Laboratorio, $Practica, $Fecha){
    include "conexion.php";
    $fechaActual = date('Y-m-d'); // Formato: Año-Mes-Día
    $Condicion = false;
    $resultados = mysqli_query($conexion,"CALL ValidarVencimiento($Laboratorio,$Practica,'$fechaActual') ");
    $consulta = mysqli_fetch_array($resultados);
    if(isset($consulta['p_tiempo'])){
        include "conexion.php";
        $s = mysqli_query($conexion,"CALL ValidarVencimiento($Laboratorio,$Practica,'$Fecha') ");
        $c = mysqli_fetch_array($s);
        if(isset($c['p_tiempo'])){
            $Condicion = true;
            $Mensaje = $consulta['p_tiempo'];
        }
        else{
            $Condicion = false;
            $Mensaje = array("Titulo" => "¡Error!", "mensaje" => "Debes seleccionar una fecha dentro de los limites de vencimiento de la practica.");
        }
    }
    else{
        $Condicion = false;
        $Mensaje = array("Titulo" => "¡Error!", "mensaje" => "La pratica que intestas realizar no esta disponible.");
    }
    return array($Condicion, $Mensaje);
}
?>