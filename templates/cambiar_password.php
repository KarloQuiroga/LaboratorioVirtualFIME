<?php
include "../static/php/conexion.php";
//Datos de url
$correo = isset($_GET["correo"]) ? $_GET["correo"] : "";
$token = isset($_GET["token"]) ? $_GET["token"] : "";

?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cambiar contraseña</title>
        <link rel="icon" href="../static/images/Icon.png">
        <link rel="stylesheet" href="../static/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../static/css/Login.css" type="text/css">
        <link rel="stylesheet" href="../static/css/Alerta.css" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="row vh-100">
                <div
                    class="Inicio my-5 col bg-light opacity-75 d-flex align-items-center justify-content-center">
                    <div class="row">
                        <div class="col my-2 text-center">
                            <section class="Titulo d-flex flex-column align-items-center mb-2">
                                <a href="../index.php">
                                    <img class="Logo img-fluid" width="20%" src="..//static/images/Logo.png" alt="">
                                </a>
                                <h1 class="Nombre">FIME REMOTO</h1>
                            </section>
                            <section class="Content">
                                <form
                                action="../static/php/controlador_cambiar_password.php?correo=<?php echo ($correo) ?>?>"
                                    method="post"
                                    class="fs-2 gap-3 d-flex flex-column align-items-center">
                                    <div class="row mx-5 gap-3 d-flex justify-content-between">
                                        <input
                                            type="password"
                                            name="U_Clave"
                                            id="inputclave"
                                            placeholder="Contraseña"
                                            class=" p-0 col-5 col-form-label"
                                            required="required">
                                        <input
                                            type="password"
                                            name="U_Clavecopia"
                                            id="inputclavecopia"
                                            placeholder="Confirmar contraseña"
                                            class=" p-0 col-5 col-form-label"
                                            required="required">
                                        <input type="hidden" name="correo" value="<?php echo ($correo); ?>">
                                        <input type="hidden" name="token" value="<?php echo ($token); ?>">
                                    </div>
                                    <input name="password" class="btn Login text-light fs-4" type="submit">
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
                <div
                    class="Facultad my-5 col bg-light opacity-50 d-flex justify-content-center align-items-center">
                    <img src="..//static/images/Fime Logo.png" class="img-fluid" width="80%">
                </div>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class= "bi bi-x-circle" viewBox = "0 0 16 16" >
                             <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                 </svg >
                        </div>
                        <div class="content">
                            <span class="title"><?php echo $_SESSION['Mensaje'] ?></span>
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
    <script src="../static/js/Olvidar.js"></script>
</body>

</html>