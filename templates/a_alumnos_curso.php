<?php
include "../static/php/controlador_sesion_admin.php";
$valorC = $_GET['Curso'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Hola";
}
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
    <link rel="stylesheet" href="../static/css/Alerta.css" type="text/css">
    <title>Alumnos del Curso <?php echo $valorC ?></title>
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
            <h2>Alumnos del curso</h2>
            <div class="datagrid">
                <table>
                    <thead>
                        <tr>
                            <th class="fs-6">Matricula</th>
                            <th class="fs-6">Nombre</th>
                            <th class="fs-6">Apellidos</th>
                            <th class="fs-6">Correo</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../static/php/conexion.php";
                        $resultados = mysqli_query($conexion, "SELECT i.ref_Curso, U.ID_Matricula, U.U_Nombre, U.U_Apellido, U.U_Clave, U.U_Correo, U_Rol, U_Estado
                                                                from usuario u, inscripcion i
                                                                where u.ID_Matricula = i.ref_Estudiante and
                                                                        ref_Curso = $valorC");
                        $isAlternateRow = false;

                        while ($consulta = mysqli_fetch_array($resultados)) {
                            // Alternar entre las filas sin clase y con clase
                            if ($isAlternateRow) {
                                echo '<tr class="alt">';
                            } else {
                                echo '<tr>';
                            }
                            $isAlternateRow = !$isAlternateRow;

                            echo '<td class="fs-6">' . $consulta['ID_Matricula'] . '</td>';
                            echo '<td class="fs-6">' . $consulta['U_Nombre'] . '</td>';
                            echo '<td class="fs-6">' . $consulta['U_Apellido'] . '</td>';
                            echo '<td class="fs-6">' . $consulta['U_Correo'] . '</td>';
                            echo '<td>';
                            echo '<center><input class="radio" type="radio" name="seleccionar[]" value="' . $consulta['ID_Matricula'] . '" data-id="' . $consulta['ID_Matricula'] . '">';
                            echo '</td>';
                            echo '</tr>';

                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mx-5 my-2 d-flex justify-content-between">
                <div>
                    <form action="../static/php/LeerCSV.php" method="POST" enctype="multipart/form-data">
                        <div class="my-2">
                            <label for="archivo">Selecciona un archivo <code>.csv</code></label>
                            <input type="file" class="form-control" name="archivo" id="archivo" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                            <input type="hidden" name="addId" id="addId" value="<?php echo $valorC ?>">
                        </div>
                       <button class="p-3 Add btn btn-success" type="submit">Agregar</button>
                    </form>
                </div>
                <div class="d-flex align-items-end">
                    <button class="p-3 btn btn-success del"> Eliminar</button>
                </div>
            </div>            
        </div>
    </div>
    <div class="modal modalAgregar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="card alert position-absolute top-50 start-50 translate-middle" id="Alert">
                    <button class="dismiss" type="button" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <h1 class="text-center">Agregar usuario</h1>
                    <section class="Content mt-5">
                        <form action="../static/php/controlador_agregar_a_curso.php" method="post"
                            class="fs-5 gap-5 d-flex flex-column  align-items-center">
                                <input type="text" name="U_Matricula" id="inputMatricula" placeholder="Matricula"
                                    class=" p-0 col-5 col-form-label" required="required">
                            <input type="hidden" name="addId" id="addId" value="<?php echo $valorC ?>">
                            <input type="submit" name="btnguardar"
                                class="btn Login col-6 mt-3 p-2 border-0 text-light fs-5 d-flex justify-content-center">
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
    <script src="../static/js/Acciones_C_Alumnos.js"></script>
    <script>
       
    </script>
</body>

</html>