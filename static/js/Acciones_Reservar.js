function Redirigir(Identificador, Clase) {
    $.ajax({
        url: "../static/php/redirigir.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Reservacion: Identificador,
                Tipo: Clase,
            })
        }
    }).done(function (response) {
        console.log(response)
        if (response.redirect_url) {
            // Redirige al usuario a la URL de agradecimiento
            window.location.href = response.redirect_url;
        }
        else {
            console.log("La reservación no fue encontrada")
        }
    }).fail(function (xhr, status, error) {
        console.log(error)
    });
}



$(document).ready(function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    if (urlParams.get('Respuesta')) {
        $('.modal').modal('show');
    };
    $("span.Eliminar").on('click', function (event) {
        $(this).closest("tr").remove();
        Identificador = $(this).closest("tr").attr("class");
        if (Identificador) {
            Redirigir(Identificador, "Reservacion")
        }
    })
    $("span.Practicar").on('click', function (event) {
        Identificador = $(this).closest("tr").attr("class");
        if (Identificador) {
            Redirigir(Identificador, "Simular")
        }
    })
})
