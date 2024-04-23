$(document).ready(function () {
    document.getElementById("inputMatricula").addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    // Evento de clic en el botón "Agregar"
    if (urlParams.get('Respuesta')) {
        $('.Alert').modal('show');
    };
    $(".radio").on("change", function () {
        $('#editId').val($(this).val());
    });
    // Evento de clic en el botón "Agregar"
    $("input.add").on('click', function (event) {
        event.preventDefault();
        $('.modalAgregar').modal('show');
    });
    // Evento de clic en el botón "Modificar"
    $("input.modify").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();

        if (selectedId) {
            // Realiza una solicitud AJAX para obtener los datos del usuario seleccionado
            $.ajax({
                type: "POST",
                url: "../static/php/obtener_datos_usuario.php",
                data: { id: selectedId },
                success: function (data) {
                    console.log("Solicitud AJAX exitosa");
                    console.log("Valor de selectedId:", selectedId);


                    // Añade un registro de la respuesta del servidor
                    console.log("Respuesta del servidor: " + data);

                    try {
                        var userData = JSON.parse(data);
                        console.log("Datos del usuario recibidos: ", userData); //Consola
                        $('#inputTipoEditar').val(userData.U_Rol);
                        $('#inputEstadoEditar').val(userData.U_Estado);
                        $('#inputCorreoEditar').val(userData.U_Correo);
                        $('#inputNombreEditar').val(userData.U_Nombre);
                        $('#inputApellidoEditar').val(userData.U_Apellido);
                        $('#inputPasswordEditar').val(userData.U_Clave);
                        $("#" + userData.U_Rol + "Editar").prop("checked", true);
                        $("#" + userData.U_Estado + "Editar").prop("checked", true);
                        $('#editId').val(selectedId);
                        (userData.U_Rol == 1) ? $("#AlumnoEditar").prop("checked", true) : $("#AdministradorEditar").prop("checked", true);
                        (userData.U_Estado == 1) ? $("#ActivoEditar").prop("checked", true) : $("#InactivoEditar").prop("checked", true);
                    } catch (e) {
                        console.error("Error al analizar la respuesta JSON: " + e);
                    }

                    // Abre el modal de edición
                    $('#modalEditar2').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud AJAX: " + textStatus + " - " + errorThrown);
                }
            });
        }
    });
});
