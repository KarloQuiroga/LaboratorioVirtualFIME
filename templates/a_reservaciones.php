<?php
include "../static/php/controlador_sesion_admin.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/Icon.png">
    <link rel="stylesheet" href="../static/css/aside.css">
    <link rel="stylesheet" href="../static/css/bootstrap-5.2.1-dist/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Modulo.css" type="text/css">
    <title>Reservaciones Tabla</title>
</head>

<body>
    <div class="wrap">
        <aside>
            <div class="div-aside">
                <h1 class="fime-aside">
                    <img src="../static/images/Logo.png" alt="" class="fime-oso">FIME Remoto
                </h1>
            </div>
            <section class="menu">
                <h2 class="title">Menú</h2>
                <ul>
                    <a href="a_reservaciones.php">
                        <li class="selected">
                            <i class="fa fa-calendar icon"></i>Reservación
                        </li>
                    </a>
                    <a href="a_alumnos.php">
                        <li>
                            <i class="fa fa-user icon"></i>Usuarios
                        </li>
                    </a>
                    <a href="a_laboratorios.php">
                        <li>
                            <i class="fa fa-book icon"></i>Laboratorios
                        </li>
                    </a>
                </ul>
            </section>
        </aside>
        <div class="dropdown position-fixed ms-5 ps-5 top-0 end-0 me-4 mt-2">
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
        <div class="alumnos">
            <h1>Calendario de actividades</h1>
            <h2>Reservaciones</h2>
            <div class="datagrid">
                <table>
                    <thead>
                        <tr>
                            <th class="fs-6">ID</th>
                            <th class="fs-6">Estudiante</th>
                            <th class="fs-6">Laboratorio</th>
                            <th class="fs-6">Practica</th>
                            <th class="fs-6">Hora</th>
                            <th class="fs-6">Fecha</th>
                            <th class="fs-6">Oportunidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../static/php/conexion.php";
                        $resultados = mysqli_query($conexion, "SELECT r.ID_Reservacion ID_Reservacion, r.ref_Estudiante ref_Estudiante, l.L_Nombre L_Nombre, p.P_Nombre P_Nombre, r.R_Hora R_Hora, r.R_Fecha R_Fecha, r.R_Oportunidad R_Oportunidad
                        FROM reservacion r, laboratorio l, practica p
                        WHERE r.ref_Laboratorio = p.ref_Laboratorio AND
                                l.ID_Laboratorio = p.ref_Laboratorio AND
                                r.ref_Practica = p.P_Numero
                                ");
                        $isAlternateRow = false;
                        while ($consulta = mysqli_fetch_array($resultados)) {
                            // Alternar entre las filas sin clase y con clase
                            if ($isAlternateRow) {
                                echo '<tr class="alt">';
                            } else {
                                echo '<tr>';
                            }
                            $isAlternateRow = !$isAlternateRow;

                            echo '<td class="fs-6"> ' . $consulta['ID_Reservacion'] . '</td>';
                            echo '<td class="fs-6"> ' . $consulta['ref_Estudiante'] .'</td>';
                            echo '<td class="fs-6"> ' . $consulta['L_Nombre'] . '</td>';
                            echo '<td class="fs-6"> ' . $consulta['P_Nombre'] . '</td>';
                            echo '<td class="fs-6"> ' . $consulta['R_Hora'] . '</td>';
                            echo '<td class="fs-6"> ' . $consulta['R_Fecha'] . '</td>';
                            echo '<td class="fs-6"> ' . $consulta['R_Oportunidad'] . '/2 </td>';

                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="../static/js/bootstrap.bundle.min.js"></script>
        <script src="../static/js/JQuery.js"></script>
</body>

</html>