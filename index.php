<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/images/Icon.png">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="static/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="static/css/Login.css" type="text/css">
    <link rel="stylesheet" href="static/css/Alerta.css" type="text/css">
</head>

<body>
    <div class="container  ">
        <div class="row vh-100">
            <div class="Inicio my-5 col bg-light opacity-75 d-flex align-items-center justify-content-center">
                <div class="row ">
                    <div class="col my-2">
                        <section class="Titulo d-flex flex-column align-items-center mb-2">
                            <img class="Logo img-fluid" width="20%" src="static/images/Logo.png" alt="">
                            <h1 class="Nombre">FIME REMOTO</h1>
                        </section>
                        <section class="Content ">
                            <form method="post" class="fs-2 gap-3 d-flex flex-column align-items-center">
                                <div class="gap-5 d-flex">
                                    <div class="form-check">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Alumno
                                        </label>
                                        <input class="form-check-input" type="radio" name="Rol"
                                            id="flexRadioDefault1" value="Alumno" checked>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Empleado
                                        </label>
                                        <input class="form-check-input" type="radio" name="Rol"
                                            id="flexRadioDefault2" value="Empleado">
                                    </div>
                                </div>
                                <input type="text" name="E_Correo" id="inputUser" placeholder="Correo"
                                    class="bg-light p-0 col-9 col-form-label">
                                <input type="password" name="E_Password" id="inputClave" placeholder="Contraseña"
                                    class="bg-light pb-0 col-9 col-form-label">
                              <button
                                    class="mt-2 Login col-6 p-2 border-0 text-light fs-4 d-flex justify-content-center">
                                    Iniciar Sesion
                                </button>
                                <p class="fs-4"><a href="templates/olvidepassword.php">¿Has olvidado tu contraseña?</a></p>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
            <div class="Facultad my-5 col bg-light opacity-50 d-flex justify-content-center align-items-center">
                <img src="static/images/Fime Logo.png" class="img-fluid" width="80%">
            </div>
        </div>
    </div>
    
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
    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script src="static/js/JQuery.js"></script>
    <script src="static/js/Login.js"></script>
</body>

</html>
