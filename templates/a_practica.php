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
            <h1>Administrar Practicas</h1>
            <h2>Practicas Registradas</h2>
            <div class="datagrid">
                <table>
                <thead>
                    <tr><th class="fs-6">Laboratorio</th>
                        <th class="fs-6">Numero</th>
                        <th class="fs-6">Practica</th>
                        <th class="fs-6">Descripcion</th>
                        <th class="fs-6">Duración</th>
                        <th class="fs-6">FechaInicio</th>
                        <th class="fs-6">FechaFin</th>
                        <th class="fs-6">Estado</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                     include "../static/php/conexion.php";

                     $labId = isset($_GET['Lab']) ? intval($_GET['Lab']) : 3; // Valor predeterminado es 3 si no se proporciona en la URL
                     $resultados = mysqli_query($conexion, "SELECT p.ID_Practica, p.P_Numero, l.L_Nombre AS NombreLaboratorio, p.P_Nombre, p.P_Descripcion, p.P_Tiempo, p.P_FechaInicio, p.P_FechaFin, p.P_Estado
                                                             FROM practica p
                                                             INNER JOIN laboratorio l ON p.ref_laboratorio = l.ID_Laboratorio
                                                             WHERE l.ID_Laboratorio = $labId
                                                             ORDER BY p.ID_Practica ASC");
                     
                     $isAlternateRow = false;

                     while ($consulta = mysqli_fetch_array($resultados)) {
                         // Alternar entre las filas sin clase y con clase
                         if ($isAlternateRow) {
                             echo '<tr class="alt">';
                         } else {
                             echo '<tr>';
                         }
                         $isAlternateRow = !$isAlternateRow;

                         echo '<td class="fs-6">' . $consulta['NombreLaboratorio'] . '</td>';
                         echo '<td class="fs-6">' .  "Practica" . " " . $consulta['P_Numero'] . '</td>';
                         echo '<td class="fs-6">' . $consulta['P_Nombre'] .'</td>';
                         echo '<td class="fs-6">' . $consulta['P_Descripcion'] . '</td>';
                         echo '<td class="fs-6">' . $consulta['P_Tiempo'] . '</td>';
                         echo '<td class="fs-6">' . $consulta['P_FechaInicio'] . '</td>';
                         echo '<td class="fs-6">' . $consulta['P_FechaFin'] . '</td>';
                         echo '<td class="fs-6">';
                            if ($consulta['P_Estado'] == 1) {
                                echo 'Activo';
                            } else {
                                echo 'Inactivo';
                            }
                            echo '</td>';
                         echo '<td class="fs-6">';
                         echo '<center><input class="radio" type="radio" name="seleccionar[]" value="' . $consulta['ID_Practica'] . '" data-id="' . $consulta['ID_Practica'] . '">'; 
                         echo '</td>';
                         echo '</tr>';
                     }
                     ?>
                 </tbody>
                </table>
            </div>
            <div class="form">
                <form action="">
                    <input type="submit" class="modify3 fs-6" value="Modificar" data-bs-toggle="modal"
                        data-bs-target="#modalEditar">
                    <input type="submit" class="add3 fs-6" value="Agregar">
                </form>
            </div>
        </div>
    </div>
    <div class="modal modalAgregar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle" id="Alert">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <h1 class="text-center">Agregar practica</h1>
                    <section class="Content mt-2">
                    <form action="../static/php/controlador_agregar_practica.php" method="post" class="fs-5 gap-3 d-flex flex-column align-items-center">
                        <div class="col d-flex gap-5"></div>
                            <div class="row mx-5 gap-4 d-flex justify-content-between">
                                <input type="text" name="P_Numero" id="inputID" placeholder="Numero de practica" class="p-0 col-5 col-form-label" required>
                                <input name="ref_laboratorio" id="inputLaboratorio" class="p-0 col-5 col-form-label" readonly="readonly" required>
                                <input type="text" name="P_Nombre" id="inputNombre" placeholder="Nombre" class="p-0 col-5 col-form-label" required>
                                <input type="text" name="P_Descripcion" id="inputPeriodo" placeholder="Descripción" class="p-0 col-5 col-form-label" required>
                                <input type="time" name="P_Tiempo" id="inputFechaI" placeholder="Tiempo" class="p-0 col-5 col-form-label" required>
                                <input type="date" name="P_FechaInicio" id="inputFechaI" placeholder="Fecha de Inicio" class="p-0 col-5 col-form-label" required>
                                <input type="date" name="P_FechaFin" id="inputFechaO" placeholder="Fecha de Fin" class="p-0 col-5 col-form-label" required>
                            </div>
                        <input type="submit" name="btnguardar" class="btn Login col-6 mt-3 p-2 border-0 text-light fs-5 d-flex justify-content-center">
                    </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modalEditar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle" id="Alert">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <h1 class="text-center">Editar practica</h1>
                    <section class="Content mt-2">
                        <form action="../static/php/controlador_editar_practica.php" method="post"
                            class="fs-5 gap-3 d-flex flex-column  align-items-center">
                            <div class="col d-flex gap-5">
                                <div class="gap-5 d-flex me-5">
                                    <div class="form-check">
                                        <label class="form-check-label" for="Activo">
                                            Activo
                                        </label>
                                        <input class="form-check-input" type="radio" name="Estado" id="Activo"
                                            value="1" checked="checked">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="Inactivo">
                                            Inactivo
                                        </label>
                                        <input class="form-check-input" type="radio" name="Estado" id="Inactivo"
                                            value="2">
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-5 gap-4 d-flex justify-content-end">
                                <input type="text" name="P_Nombre" id="inputNombreEditar" placeholder="Nombre" class="p-0 col-7 col-form-label" required>
                                Tiempo:<input type="time" name="P_Tiempo" id="inputTiempoEditar" placeholder="Tiempo" class="p-0 col-2 col-form-label" required>
                                <input type="text" name="P_Descripcion" id="inputDescripcionEditar" placeholder="Descripción" class="p-0 col-5 col-form-label" required>
                                Desde:<input type="date" name="P_FechaInicio" id="inputFechaIEditar" placeholder="Fecha de Inicio" class="p-0 col-4 col-form-label" required>
                                Hasta:<input type="date" name="P_FechaFin" id="inputFechaOEditar" placeholder="Fecha de Fin" class="p-0 col-4 col-form-label" required>
                            </div>
                                <input type="submit" name="btnguardar" class="btn Login col-6 mt-3 p-2 border-0 text-light fs-6 d-flex justify-content-center">
                                <input type="hidden" name="editId" id="editId">
                                <input type="hidden" name="lab" id="lab" value="<?php echo $labId; ?>">
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
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
    <input type="hidden" name="editId" id="editId">
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/JQuery.js"></script>
    <script src="../static/js/Acciones_Practicas.js"></script>
    <script>
        $(".radio").on("change", function () {
            $('#editId').val($(this).val());
        });
    </script>
</body>
</html>
