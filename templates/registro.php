<?php
include "../static/php/conexion.php";
include "../static/php/controlador_registro.php";
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" href="../static/images/Icon.png">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../static/css/Login.css" type="text/css">
</head>

<body>
    <div class="container ">
        <div class=" row vh-100">
            <div class="Inicio my-5 col bg-light opacity-75 d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col my-2">
                        <section class="Titulo d-flex flex-column align-items-center mb-2">
                            <img class="Logo img-fluid" width="20%" src="..//static/images/Logo.png" alt="">
                            <h1 class="Nombre">FIME REMOTO</h1>
                        </section>
                        <section class="Content ">
                            <form action="../static/php/controlador_registro.php" method="post" class="fs-2 gap-3 d-flex flex-column align-items-center">
                                <div class="row mx-5 gap-3 d-flex justify-content-between">
                                    <input type="text" name="Codigo" id="inputNombre" placeholder="Codigo"
                                        class="bg-light p-0 col-5 col-form-label" required>
                                    <input type="text" name="Matricula" id="inputCorreo" placeholder="Matricula"
                                        class="bg-light p-0 col-5 col-form-label" required>
                                </div>
                                <input name = "registro" class="btn Login text-light fs-4" type="submit">
                            </form>
                        </section>
                    </div>
                </div>
            </div>
            <div class="Facultad my-5 col bg-light opacity-50 d-flex justify-content-center align-items-center">
                <img src="..//static/images/Fime Logo.png" class="img-fluid" width="80%">
            </div>
        </div>
    </div>
    <script src="{{ url_for('static',filename='js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
