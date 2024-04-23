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
        <link
            rel="stylesheet"
            href="../static/css/bootstrap-5.2.1-dist/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../static/css/Modulo.css" type="text/css">
        <link rel="stylesheet" href="../static/css/Alerta.css" type="text/css">
        <title>Laboratorios Tabla</title>
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
                            <li class="selected">
                                <i class="fa fa-book icon"></i>Laboratorios
                            </li>
                        </a>
                    </ul>
                </section>
            </aside>
            <div class="Contenedor dropdown position-fixed ms-5 ps-5 top-0 end-0 me-4 mt-2">
                <a
                    class="Perfil dropdown-toggle d-flex align-items-center justify-content-end text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img
                        src="../static/images/Usuario.png"
                        alt="hugenerd"
                        width="40rem"
                        class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1"></span>
                </a>
                <ul class="dropdown-menu shadow ">
                    <div class="d-flex align-items-center px-4">
                        <section class="Info ">
                            <p>
                                <strong><?php echo $_SESSION["Correo"] ?></strong>
                            </p>
                            <div class="text-center"><img class="Usuario" height="100px" src="../static/images/Usuario.png" alt=""></div>
                            <p class="my-1">
                                <strong>Nombre:
                                    <?php echo $_SESSION["Nombre"] ?></strong>
                            </p>
                            <p class="my-1">
                                <strong>Apellidos:
                                    <?php echo $_SESSION["Apellido"]; ?></strong>
                            </p>
                            <p class="my-1">
                                <strong>Matricula:
                                    <?php echo $_SESSION["Matricula"]; ?></strong>
                            </p>
                            <a
                                href="../static/php/controlador_cerrar_sesion.php"
                                class="py-2 d-flex justify-content-center align-items-center text-decoration-none">
                                <div class="btn btn-success Login text-light" type="button">Cerrar Sesion
                                </div>
                            </a>
                        </section>
                    </div>
                </ul>
            </div>
            <div class="alumnos">
                <h1>Administrar Laboratorios</h1>
                <h2>Laboratorios Registrados</h2>
                <div class="datagrid">
                    <table>
                        <thead>
                            <tr>
                                <th class="fs-6">ID</th>
                                <th class="fs-6">Nombre</th>
                                <th class="fs-6">Periodo</th>
                                <th class="fs-6">Fecha de Inicio</th>
                                <th class="fs-6">Fecha de fin</th>
                                <th class="fs-6">Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                     include "../static/php/conexion.php";
                     $resultados = mysqli_query($conexion, "SELECT * FROM laboratorio ORDER BY ID_Laboratorio ASC");
                     $isAlternateRow = false;

                     while ($consulta = mysqli_fetch_array($resultados)) {
                         // Alternar entre las filas sin clase y con clase
                         if ($isAlternateRow) {
                             echo '<tr class="alt">';
                         } else {
                             echo '<tr>';
                         }
                         $isAlternateRow = !$isAlternateRow;

                         echo '<td class="fs-6"> ' . $consulta['ID_Laboratorio'] . '</td>';
                         echo '<td class="fs-6"> ' . $consulta['L_Nombre'] . '</td>';
                         echo '<td class="fs-6"> ' . $consulta['L_Periodo'] . '</td>';
                         echo '<td class="fs-6"> ' . $consulta['L_FechaInicio'] . '</td>';
                         echo '<td class="fs-6"> ' . $consulta['L_FechaFin'] . '</td>';
                         echo '<td class="fs-6">';
                            if ($consulta['L_Estado'] == 1) {
                                echo 'Activo';
                            } else {
                                echo 'Inactivo';
                            }
                            echo '</td>';
                         echo '<td class="fs-6"> ';
                         echo '<center><input class="radio" type="radio" name="seleccionar[]" value="' . $consulta['ID_Laboratorio'] . '" data-id="' . $consulta['ID_Laboratorio'] . '">'; 
                         echo '</td>';
                         echo '</tr>';
                     }
                     ?>
                        </tbody>
                    </table>
                </div>
                <div class="form">
                    <form action="">
                        <input
                            type="submit"
                            class="modify2 fs-6"
                            value="Modificar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditar">
                        <input type="submit" class="add2 fs-6" value="Agregar">
                        <input
                            type="submit"
                            class="verpractica fs-6"
                            value="Ver prácticas"
                            id="verPracticasBtn">
                        <input
                            type="submit"
                            class="vercursos fs-6"
                            value="Ver cursos"
                            id="verCursosBtn">
                    </form>
                </div>
            </div>
        </div>
        <div class="modal modalAgregar">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div
                        class="card alert position-absolute top-50 start-50 translate-middle"
                        id="Alert">
                        <button
                            class="dismiss"
                            type="button"
                            data-bs-dismiss="modal"
                            aria-label="Close">×</button>
                        <h1 class="text-center">Agregar laboratorio</h1>
                        <section class="Content mt-2">
                            <form
                                action="../static/php/controlador_agregar_laboratorio.php"
                                method="post"
                                class="fs-5 gap-3 d-flex flex-column  align-items-center">
                                <div class="col d-flex gap-5"></div>
                                <div class="row mx-5 gap-4 d-flex justify-content-between">
                                    <input
                                        type="text"
                                        name="L_Nombre"
                                        id="inputNombre"
                                        placeholder="Nombre"
                                        class="p-0 col-5 col-form-label"
                                        required="required">
                                    <input
                                        type="text"
                                        name="L_Periodo"
                                        id="inputPeriodo"
                                        placeholder="Periodo"
                                        class="p-0 col-5 col-form-label"
                                        required="required">
                                    <input
                                        type="date"
                                        name="L_FechaInicio"
                                        id="inputFechaI"
                                        placeholder="Fecha de Inicio"
                                        class="p-0 col-5 col-form-label"
                                        required="required">
                                    <input
                                        type="date"
                                        name="L_FechaFin"
                                        id="inputFechaO"
                                        placeholder="Fecha de Fin"
                                        class="p-0 col-5 col-form-label"
                                        required="required">
                                </div>
                                <input
                                    type="submit"
                                    name="btnguardar"
                                    class="btn Login col-6 mt-3 p-2 border-0 text-light fs-5 d-flex justify-content-center">
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modalEditar">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div
                        class="card alert position-absolute top-50 start-50 translate-middle"
                        id="Alert">
                        <button
                            class="dismiss"
                            type="button"
                            data-bs-dismiss="modal"
                            aria-label="Close">×</button>
                        <h1 class="text-center">Modificar laboratorio</h1>
                        <section class="Content mt-2">
                            <form
                                action="../static/php/controlador_editar_laboratorio.php"
                                method="post"
                                class="fs-5 gap-3 d-flex flex-column  align-items-center">
                                <div class="col d-flex gap-5">
                                <div class="gap-5 d-flex me-5">
                                    <div class="form-check">
                                        <label class="form-check-label" for="Activo">
                                            Activo
                                        </label>
                                        <input class="form-check-input" type="radio" name="Estado" id="ActivoEditar"
                                            value="1" checked="checked">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="Inactivo">
                                            Inactivo
                                        </label>
                                        <input class="form-check-input" type="radio" name="Estado" id="InactivoEditar"
                                            value="2">
                                    </div>
                                </div>
                            </div>
                                <div class="row mx-5 gap-4 d-flex justify-content-between">
                                    <input
                                        type="text"
                                        name="L_Nombre"
                                        id="inputNombreEditar"
                                        placeholder="Nombre"
                                        class=" p-0 col-5 col-form-label"
                                        required="required">
                                    <input
                                        type="text"
                                        name="L_Periodo"
                                        id="inputPeriodoEditar"
                                        placeholder="Periodo"
                                        class=" p-0 col-5 col-form-label"
                                        required="required">
                                    <input
                                        type="date"
                                        name="L_FechaInicio"
                                        id="inputFechaIEditar"
                                        placeholder="FechaInicio"
                                        class=" p-0 col-5 col-form-label"
                                        required="required">
                                    <input
                                        type="date"
                                        name="L_Fechafin"
                                        id="inputFechaOEditar"
                                        placeholder="FechaFin"
                                        class=" p-0 col-5 col-form-label"
                                        required="required">
                                </div>
                                <input
                                    type="submit"
                                    name="btnguardar"
                                    class="btn Login col-6 mt-3 p-2 border-0 text-light fs-5 d-flex justify-content-center">
                                <input type="hidden" name="editId" id="editId">
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="editId" id="editId">
        <div class="modal Alert">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="header">
                        <div class="duda">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>
                        </div>
                        <div class="content">
                            <span class="title">
                            <?php echo $_SESSION['Estado'] ?>    
                        </span>
                            <p class="message">
                            <?php echo $_SESSION['Mensaje'] ?>
                            </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
         </div>    
        <script src="../static/js/bootstrap.bundle.min.js"></script>
        <script src="../static/js/JQuery.js"></script>
        <script src="../static/js/Acciones_Laboratorio.js"></script>
        <script src="../static/js/Botones_Laboratorio.js"></script>
        <script>
            $(".radio").on("change", function () {
                $('#editId').val($(this).val());
            });
        </script>
    </body>
</html>