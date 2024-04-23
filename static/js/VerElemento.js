function VerElemento(Elemento, Clase, Codigo) {
    $.ajax({
        url: "../static/php/redirigir.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Lab: Elemento,
                Tipo: Clase,
                Test: Codigo
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
    $("div.card").on('click', function (event) {
        event.preventDefault();
        Identificador = $(this).attr("id")
        Tipo = $("div#" + Identificador).attr("title")
        Codigo = $("div#" + Identificador).attr("name")
        console.log(Identificador)
        console.log(Tipo)
        console.log(Codigo)
        VerElemento(Identificador, Tipo, Codigo)
    })
});