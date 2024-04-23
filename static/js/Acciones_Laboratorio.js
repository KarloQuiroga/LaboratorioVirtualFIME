function VerElemento(Elemento, Tipo) {
    $.ajax({
        url: "../static/php/redirigir.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Lab: Elemento,
                Tipo: Tipo,
            })
        }
    }).done(function (data) {
        console.log(data)
        if (data.redirect_url) {
            // Redirige al usuario a la URL de agradecimiento
            window.location.href = data.redirect_url;
        }
        //$(location).attr('href', Ruta)
    }).fail(function (xhr, status, error) {
        console.log(error)
    });
}

$(document).ready(function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    // Evento de clic en el botón "Agregar"
    if (urlParams.get('Respuesta')) {
        $('.Alert').modal('show');
    };
    $("input.vercursos").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();
        if (selectedId) {
            VerElemento(selectedId, "a_Cursos")
        }
    })
    $("input.verpractica").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();
        if (selectedId) {
            VerElemento(selectedId, "a_Laboratorio")
        }
    })
    $("input.modify2").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();

        if (selectedId) {
            // Realiza una solicitud AJAX para obtener los datos del laboratorio seleccionado
            $.ajax({
                type: "POST",
                url: "../static/php/obtener_datos_laboratorio.php",
                data: { id: selectedId },
                success: function (data) {
                    console.log("Solicitud AJAX exitosa");
                    console.log("Valor de selectedId:", selectedId);

                    // Añade un registro de la respuesta del servidor
                    console.log("Respuesta del servidor: " + data);

                    try {
                        var labData = JSON.parse(data);
                        console.log("Datos del laboratorio recibidos: ", labData); //Consola

                        // Rellena los campos del formulario del modal con los datos del laboratorio
                        $('#inputIDEditar').val(labData.L_Laboratorio);
                        $('#inputNombreEditar').val(labData.L_Nombre);
                        $('#inputPeriodoEditar').val(labData.L_Periodo);
                        $('#inputFechaIEditar').val(labData.L_FechaInicio);
                        $('#inputFechaOEditar').val(labData.L_FechaFin);
                        $('#editId').val(selectedId);
                        (labData.L_Estado == 1) ? $("#ActivoEditar").prop("checked", true) : $("#InactivoEditar").prop("checked", true);
                    } catch (e) {
                        console.error("Error al analizar la respuesta JSON: " + e);
                    }

                    // Abre el modal de edición
                    $('.modalEditar').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud AJAX: " + textStatus + " - " + errorThrown);
                }
            });
        }
    });
});





