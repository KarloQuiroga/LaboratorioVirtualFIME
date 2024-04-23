<?php   
include "../static/php/controlador_sesion_alumno.php";
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/Icon.png">
    <title>Laboratorios</title>
    <link rel="stylesheet" href="../static/css/Practicas.css" type="text/css">
    <link rel="stylesheet" href="../static/css/bootstrap-5.2.1-dist/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Menu.css" type="text/css">
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
                        <a class="nav-link active" href="laboratorios.php">Laboratorio</a>
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
    <div class="row gap-4 mx-5 mt-2 d-flex justify-content-center">
        <h1 class="mb-0 fw-bold text-center">FIME Remoto</h1>
          <?php
            include "../static/php/conexion.php";
            $resultados = mysqli_query($conexion,"SELECT * from laboratorioinscrito where Estudiante='$Usuario'");
            while($consulta = mysqli_fetch_array($resultados)) {
            $miNumero = $consulta['ID'];
          ?>
        <div class="card col-lg-5 Lab" id="<?php echo $miNumero;?>" title="Laboratorio">
            <div class="image"><img src="..//static/images/FIME_1.jpg" alt=""></div>
            <div class="content Laboratorio">
                <p class="title m-0 fs-1">
                    Laboratorio de <?=$consulta['Laboratorio']?>
                </p>
                <p class="desc m-0 fs-4">
                    <?="Fecha de inicio: ".$consulta['Inicio']?>
                </p>
                <p class="desc m-0 fs-4">
                    <?="Fecha de fin: ".$consulta['Fin']?>
                </p>
            </div>
        </div>
        <?php  } ?>
    </div>
    <footer class="text-center mb-2">
        <img src="..//static/images/ViveLaFime.png" width="150rem">
    </footer>
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/JQuery.js"></script>
    <script src="../static/js/VerElemento.js"></script>
</body>
</html>