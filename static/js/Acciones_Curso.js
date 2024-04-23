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
    $("input.veralumnos").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();
        console.log(selectedId)
        VerElemento(selectedId, "a_Cursos_Alumnos")
    })
    // Evento de clic en el botón "Agregar"
    $("input.add4").on('click', function (event) {
        event.preventDefault();
        $('.modalAgregar').modal('show');
    });

    // Evento de clic en el botón "Modificar"
    $("input.modify4").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();

        if (selectedId) {
            // Realiza una solicitud AJAX para obtener los datos del laboratorio seleccionado
            $.ajax({
                type: "POST",
                url: "../static/php/obtener_curso.php",
                data: { id: selectedId },
                success: function (data) {
                    console.log("Solicitud AJAX exitosa");
                    console.log("Valor de selectedId:", selectedId);

                    // Añade un registro de la respuesta del servidor
                    console.log("Respuesta del servidor: " + data);

                    try {
                        var labData = JSON.parse(data);
                        console.log("Datos del laboratorio recibidos: ", labData[0]); //Consola

                        // Rellena los campos del formulario del modal con los datos del laboratorio
                        $('#inputBrigadaEditar').val(labData[0].C_Brigada);
                        $('#editId').val(selectedId);
                        (labData[0].C_Estado == 1) ? $("#ActivoEditar").prop("checked", true) : $("#InactivoEditar").prop("checked", true);
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
