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
    <title>Alumnos Tabla</title>
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
                        <li>
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
            <h1>Administrar Alumnos</h1>
            <h2>Alumnos Registrados</h2>
            <div class="datagrid">
                <table>
                <thead>
                    <tr><th>Matricula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                     include "../static/php/conexion.php";
                     $resultados = mysqli_query($conexion, "SELECT * FROM  ORDER BY U_Nombre ASC");
                     $isAlternateRow = false;

                     while ($consulta = mysqli_fetch_array($resultados)) {
                         // Alternar entre las filas sin clase y con clase
                         if ($isAlternateRow) {
                             echo '<tr class="alt">';
                         } else {
                             echo '<tr>';
                         }
                         $isAlternateRow = !$isAlternateRow;

                         echo '<td>' . $consulta['U_Matricula'] . '</td>';
                         echo '<td>' . $consulta['U_Nombre'] . '</td>';
                         echo '<td>' . $consulta['U_Apellido'] . '</td>';
                         echo '<td>' . $consulta['U_Correo'] . '</td>';
                         echo '<td>' . $consulta['U_Rol'] . '</td>';
                         echo '<td>';
                                   if ($consulta['U_Estado'] == 1) {
                                       echo 'Activo';
                                   } else {
                                       echo 'Inactivo';
                                   }
                                   echo '</td>';
                         echo '</tr>';
                     }
                     ?>
                 </tbody>
                </table>
            </div>
            <div class="form">
                <form action="">
                    <input type="submit" value="Eliminar">
                    <input type="submit" value="Modificar">
                    <input type="submit" class="add" value="Agregar">
                </form>
            </div>
        </div>
    </div>
    <div class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle" id="Alert">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <h1 class="text-center">Agregar</h1>
                    <section class="Content mt-2">
                        <form action="static/php/controlador_login.php" method="post"
                            class="fs-5 gap-3 d-flex flex-column  align-items-center">
                            <div class="col d-flex gap-5">
                                <div class="gap-5 d-flex me-5">
                                    <div class="form-check">
                                        <label class="form-check-label" for="Alumno">
                                            Alumno
                                        </label>
                                        <input class="form-check-input" type="radio" name="Tipo" id="Alumno" checked>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="Docente">
                                            Docente
                                        </label>
                                        <input class="form-check-input" type="radio" name="Tipo" id="Docente">
                                    </div>
                                </div>
                                <div class="gap-5 d-flex ms-5">
                                    <div class="form-check">
                                        <label class="form-check-label" for="Activo">
                                            Activo
                                        </label>
                                        <input class="form-check-input" type="radio" name="Estado" id="Activo" checked>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="Inactivo">
                                            Inactivo
                                        </label>
                                        <input class="form-check-input" type="radio" name="Estado" id="Inactivo">
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-5 gap-4 d-flex justify-content-between">
                                <input type="text" name="U_Matricula" id="inputMatricula" placeholder="Matricula"
                                    class=" p-0 col-5 col-form-label" required>
                                <input type="text" name="U_Correo" id="inputCorreo" placeholder="Correo"
                                    class=" p-0 col-5 col-form-label" required>
                                <input type="text" name="U_Nombre" id="inputNombre" placeholder="Nombre"
                                    class=" p-0 col-5 col-form-label" required>
                                <input type="text" name="E_Apellido" id="inputApellido" placeholder="Apellido"
                                    class=" p-0 col-5 col-form-label" required>
                                <input type="password" name="E_Password" id="inputPassword" placeholder="Contraseña"
                                    class=" p-0 col-5 col-form-label" required>
                                <input type="password" name="E_PasswordCopy" id="inputPasswordCopy"
                                    placeholder="Confirmar contraseña" class=" p-0 col-5 col-form-label" required>
                            </div>
                            <input type="submit" name="btnguardar"
                                class="btn Login col-6 mt-3 p-2 border-0 text-light fs-5 d-flex justify-content-center">
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/JQuery.js"></script>
    <script src="../static/js/Acciones.js"></script>

</body>
</html>
