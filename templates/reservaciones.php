<?php
include "../static/php/controlador_sesion_alumno.php";
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/Icon.png">
    <title>Reservaciones</title>
    <link rel="stylesheet" href="../static/css/bootstrap-5.2.1-dist/font-awesome-4.7.0/css/font-awesome.min.css"
        type="text/css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Menu.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Citas.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Alerta.css" type="text/css">
</head>

<body>
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
    <nav class="navbar navbar-dark navbar-expand-lg">
        <div class="container-fluid justify-content-end mt-5 py-3">
            <div class="position-absolute start-0 ms-2 px-2 Logo h2"><img class="Logo" src="../static/images/Logo.png"
                    height="200px">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link active" href="reservaciones.php">Reservaciones</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="laboratorios.php">Laboratorio</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown position-fixed ms-5 ps-5 top-0 end-0 me-4 mt-2">
                <a class="Perfil dropdown-toggle d-flex align-items-center justify-content-end text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../static/images/Usuario.png" alt="hugenerd" width="40rem" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1"></span>
                </a>
                <ul class="dropdown-menu shadow ">
                    <div class="d-flex align-items-center px-4">
                        <section class="Info ">
                            <p> <strong>
                                    <?php echo $_SESSION["Correo"]; ?>
                                </strong></p>
                            <div class="text-center"><img class="Usuario" height="100px"
                                    src="../static/images/Usuario.png" alt=""></div>
                            <p class="my-1"><strong>Nombre:
                                    <?php echo $_SESSION["Nombre"] ?>
                                </strong> </p>
                            <p class="my-1"><strong>Apellidos:
                                    <?php echo $_SESSION["Apellido"]; ?>
                                </strong></p>
                            <p class="my-1"><strong>Matricula:
                                    <?php echo $_SESSION["Matricula"]; ?>
                                </strong> </p>
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
    <h1 class="fw-bold mb-4 mt-2 text-center">Reservaciones</h1>
    <div class="table-responsive mx-4 text-center rounded d-flex align-items-center">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="text-light">
                    <th scope="col">Laboratorio</th>
                    <th scope="col">Práctica</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Oportunidad</th>
                    <th class="col">Practicar</th>
                    <th class="col">Cancelar</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                include "../static/php/conexion.php";
                $resultados = mysqli_query($conexion, "CALL VerReservacion($Usuario)");
                while ($consulta = mysqli_fetch_array($resultados)) {
                ?>
                    <tr class="<?= $consulta['id_reservacion'] ?>">
                        <td>Laboratorio de
                            <?= $consulta['L_Nombre'] ?>
                        </td>
                        <td>
                            <?= $consulta['practica'] ?>
                        </td>
                        <td>
                            <?= $consulta['r_fecha'] ?>
                        </td>
                        <td>
                            <?= $consulta['r_hora'] ?>
                        </td>
                        <td>
                            <?= $consulta['r_oportunidad'] ?>/2
                        </td>
                        <td class="col-1">
                            <span class="Practicar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-wrench" width="30%"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11l.471.242z" />
                                </svg>
                            </span>
                        </td>
                        <td class=" col-1">
                            <span class="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3-fill"
                                    width="30%" width="10%" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal Alert">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle" id="Alert">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="header">
                        <div class="images" id="svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class= "bi bi-x-circle" viewBox = "0 0 16 16" >
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                           </svg >
                        </div>
                        <div class="content">
                            <span class="title">¡Error!</span>
                            <p class="message mt-1">
                                <?php echo $_SESSION['Mensaje'] ?>
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
    <script src="../static/js/Acciones_Reservar.js"></script>
</body>

</html>