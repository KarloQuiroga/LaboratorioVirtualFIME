$(document).ready(function () {
    document.getElementById("inputID").addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    // Evento de clic en el botón "Agregar"
    if (urlParams.get('Respuesta')) {
        $('.Alert').modal('show');
    };
    $("input.add3").on('click', function (event) {
        event.preventDefault();
        $('.modalAgregar').modal('show');
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        console.log(urlParams.get('Lab'))
        $('#inputLaboratorio').val(urlParams.get('Lab'))
    });

    // Evento de clic en el botón "Modificar"
    $("input.modify3").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();

        if (selectedId) {
            // Realiza una solicitud AJAX para obtener los datos de las prácticas seleccionadas
            $.ajax({
                type: "POST",
                url: "../static/php/obtener_datos_practica.php",
                data: { id: selectedId },
                success: function (data) {
                    console.log("Solicitud AJAX exitosa");
                    console.log("Valor de selectedId:", selectedId);

                    // Añade un registro de la respuesta del servidor
                    console.log("Respuesta del servidor: " + data);

                    try {
                        var practicaData = JSON.parse(data);
                        console.log("Datos de la práctica recibidos: ", practicaData);

                        // Rellena los campos del formulario del modal con los datos de las prácticas
                        $('#inputIDEditar').val(practicaData.P_Practica);
                        // Asigna el valor seleccionado en el campo de selección de laboratorio
                        $('#inputLaboratorioEditar').val(practicaData.ref_Laboratorio);
                        $('#inputNombreEditar').val(practicaData.P_Nombre);
                        $('#inputDescripcionEditar').val(practicaData.P_Descripcion);
                        $('#inputTiempoEditar').val(practicaData.P_Tiempo);
                        $('#inputFechaIEditar').val(practicaData.P_FechaInicio);
                        $('#inputFechaOEditar').val(practicaData.P_FechaFin);
                        $('#editId').val(selectedId);
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





