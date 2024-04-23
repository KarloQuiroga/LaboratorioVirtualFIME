<?php   
    include "../static/php/controlador_sesion_alumno.php";
     if (isset($_GET['Lab']) && isset($_GET['Práctica'])) {
              $Lab = $_GET['Lab'];
              $Test = $_GET['Práctica'];
          } else {
            echo "No se ha recibido ningún ID";
      }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/Icon.png">
    <title>Reservar Práctica</title>
    <link rel="stylesheet" href="../static/css/bootstrap-5.2.1-dist/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Menu.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Agendar.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Alerta.css" type="text/css">
</head>

<body>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
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
            <div class="Contenedor dropdown position-fixed ms-5 ps-5 top-0 end-0 me-4 mt-2">
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

          <?php
            include "../static/php/conexion.php";
            $resultados = mysqli_query($conexion,"CALL verpractica($Test,$Lab)");
            $consulta = mysqli_fetch_array($resultados);
          ?>
    <main class="mx-5 mt-4 mb-2">
        <div class="row  d-flex justify-content-center">
            <div class="col-12 col-lg-7 justify-content-start">
                <h1 class="Practica fs-2 fw-bold">Práctica # <?=$consulta['P_Numero']?>. <?=$consulta['P_Nombre']?>
                </h1>

                <h2 class="fs-3 fw-bold">Elementos de competencia</h2>
                <div class="content fs-4">
                    <p><?=$consulta['P_Descripcion']?></p>
                    <p><strong>Tiempo:</strong> <?=$consulta['P_Tiempo']?></p>
                    <p><strong>Desde:</strong> <?=$consulta['P_FechaInicio']?></p>
                    <p><strong>Hasta:</strong> <?=$consulta['P_FechaFin']?></p>
                </div>
            </div>
            <div class="col-10 col-lg-4 text-dark d-flex align-items-center">
                <div class="card col-12">
                    <form class="form-signin p-4 fs-4" method="POST">
                        <h1 class="mb-3 fs-2 fw-bold text-dark"> Reservación</h1>
                        <label for="inputHora" class="fw-bold">Hora</label>
                        <input type="time" id="inputHora" name="inputHora" class="form-control mb-2">
                        <label for="inputFecha" class="sr-only mb-2 fw-bold">Dia</label>
                        <input type="date" id="inputFecha" name="inputFecha" class="form-control mb-4">
                        <div class="d-flex justify-content-center">
                            <button class="Reservar btn btn-success">Reservar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <div class="modal Alert">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle" id="Alert">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="header">
                        <div class="images" id="svg">
                        </div>
                        <div class="content">
                            <span class="title"></span>
                            <p class="message">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mb-2">
        <img src="..//static/images/ViveLaFime.png" width="150rem">
    </footer>
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/JQuery.js"></script>
    <script src="../static/js/ReservarPractica.js"></script>
</body>

</html>
