function CambiarAlumno(ID) {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    $.ajax({
        url: "../static/php/controlador_alumnos_curso.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Estudiante: ID,
                Curso: urlParams.get('Curso')
            })
        }
    }).done(function (response) {
        console.log(response)
        if (response.mensaje = "Bien") {
            url = "a_alumnos_curso.php?Curso=" + urlParams.get('Curso')
            window.location.href = url
        }
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
    document.getElementById("inputMatricula").addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $(".radio").on("change", function () {
        $('#editId').val($(this).val());
    });
    $("button.del").on('click', function (event) {
        event.preventDefault();
        var selectedId = $("input[name='seleccionar[]']:checked").val();
        if (selectedId) {
            // Realiza una solicitud AJAX para obtener los datos del usuario seleccionado
            CambiarAlumno(selectedId)
        }
    });
});
