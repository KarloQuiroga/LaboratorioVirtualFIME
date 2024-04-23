function Reservar(Dia, Hora) {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    console.log(urlParams.get('Lab'))
    $.ajax({
        url: "../static/php/controlador_reservar.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Fecha: Dia,
                Tiempo: Hora,
                Lab: urlParams.get('Lab'),
                Test: urlParams.get('Práctica'),
            })
        }
    }).done(function (response) {
        console.log(response)
        if (response) {
            console.log(response.Titulo)
            console.log(response.mensaje)
        }
        $("div.content span").text(response.Titulo);
        $("div.content p.message").text(response.mensaje);
        $("div.header div#svg svg").remove()
        $('div#svg').removeClass()
        if (response.Titulo == "¡Exito!") {
            $('div#svg').addClass("image");
            $("div.header div.image").append(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-check-circle" viewBox="0 0 16 16">
             <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
             <path
                 d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
         </svg>`);
        }
        else {
            $('div#svg').addClass("images");
            $("div.header div.images").append(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class= "bi bi-x-circle" viewBox = "0 0 16 16" >
                 <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                 <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                 </svg > `);
        }
        $('.modal').modal('show');
    }).fail(function (xhr, status, error) {
        console.log(error)
    });
}


$(document).ready(function () {
    $("button.Reservar").on('click', function (event) {
        event.preventDefault()
        Hora = $("input#inputHora").val()
        Fecha = $("input#inputFecha").val()
        console.log("Click")
        Reservar(Fecha, Hora)
    })
});
