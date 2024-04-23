<?php
    include "../static/php/controlador_sesion_alumno.php";
    include "../static/php/conexion.php";
    function Salir(){
        header("location: ../templates/reservaciones.php?Respuesta=1");
    }
    if (isset($_GET['Res'])) {
        $Reservacion = $_GET['Res'];
        date_default_timezone_set('America/Monterrey');
        $resultados = mysqli_query($conexion,"select Inicio, Fin, fecha from Agenda where ref_Estudiante= $Usuario and ID =$Reservacion");
        $fechaActual = date('Y-m-d'); 
        $HoraActual = date('H:i:s');
        $consulta = mysqli_fetch_array($resultados);
        if(isset($consulta["Inicio"], $consulta["Fin"], $consulta["fecha"])){
            if ($fechaActual != $consulta["fecha"]) {
                $_SESSION['Mensaje'] = "La practica no esta disponible";
                Salir();
            }
            if ($HoraActual >= $consulta["Inicio"] && $HoraActual < $consulta["Fin"]) {
                $resultados = mysqli_query($conexion,"call TiempoSimulado ($Usuario,$Reservacion)");
                $consulta = mysqli_fetch_array($resultados);
                if(isset($consulta["Tiempo"])){
                    $partes = explode(":", $consulta["Tiempo"]);
                    $horas = $partes[0];
                    $minutos = $partes[1];
                    $segundos = $partes[2];
                }
                else{
                    $horas = '00';
                    $minutos = '00';
                    $segundos = '00';   
                }
            }
            else{
                $_SESSION['Mensaje'] = "La practica no esta disponible";
                Salir();
            }
        }
        else{
            $_SESSION['Mensaje'] = "La practica no esta disponible";
            Salir();
        }
    } else {
        $_SESSION['Mensaje'] = "No se ha recibieron los parametros";
        Salir();
    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador</title>
    <link rel="icon" href="../static/images/Icon.png">
    <link rel="stylesheet" href="../static/css/bootstrap-5.2.1-dist/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Menu.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Agendar.css" type="text/css">
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-lg">
        <div class="container-fluid justify-content-end mt-5 py-3">
            <div class="position-absolute start-0 ms-2 px-2 Logo h2"><img class="Logo"
                    src="../static/images/Logo.png" height="200px">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link" href="reservaciones.php">Reservaciones</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="laboratorios.php">Laboratorio</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown position-absolute ms-5 ps-5 top-0 end-0 me-4 mt-2">
                <a class="Perfil dropdown-toggle d-flex align-items-center justify-content-end text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../static/images/Usuario.png" alt="hugenerd" width="40rem"
                        class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1"></span>
                </a>
                <ul class="dropdown-menu shadow ">
                    <div class="d-flex align-items-center px-4">
                    <section class="Info ">
                            <p> <strong><?php echo $_SESSION["Correo"]; ?></strong></p>
                            <div class="text-center"><img class="Usuario" height="100px"
                                    src="../static/images/Usuario.png" alt=""></div>
                            <p class="my-1"><strong>Nombre: <?php echo $_SESSION["Nombre"] ?></strong> </p>
                            <p class="my-1"><strong>Apellidos: <?php echo $_SESSION["Apellido"]; ?></strong></p>
                            <p class="my-1"><strong>Matricula: <?php echo $_SESSION["Matricula"]; ?></strong> </p>
                            <a href="../static/php/controlador_cerrar_sesion.php"
                                class="py-2 d-flex justify-content-center align-items-center text-decoration-none">
                                <div class="btn btn-success Login text-light" type="button">Cerrar Sesion
                                </div>
                            </a>
                        </section>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <main class="mx-5 mt-5 mb-5">
        <div class="cronometro">
            <h1>Tiempo</h1>
            <div class="Tiempo"><span class="Hora"><?php echo $horas; ?></span> : <span class="Minutos"><?php echo $minutos; ?></span> : <span
                    class="Segundos"><?php echo $segundos; ?></span>
            </div>
    </main>
    <footer class="text-center mb-2">
        <img src="..//static/images/ViveLaFime.png" width="150rem">
    </footer>
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/JQuery.js"></script>
    <script src="../static/js/Cronometro.js"></script>
</body>

</html>
