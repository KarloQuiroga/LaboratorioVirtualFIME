function Ingresar(Elemento, Clase, Psw) {
    $.ajax({
        url: "static/php/controlador_login.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Matricula: Elemento,
                Rol: Clase,
                Clave: Psw
            })
        }
    }).done(function (response) {
        console.log(response)
        if (response.redirect_url) {
            // Redirige al usuario a la URL de agradecimiento
            window.location.href = response.redirect_url;
        }
        $("div.content span").text(response.Titulo);
        $("div.content p.message").text(response.mensaje);
        $("div.header div#svg svg").remove()
        $('div#svg').removeClass();
        if (response.Titulo == "¡Error!") {
            $('div#svg').addClass("images");
            $("div.header div.images").append(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class= "bi bi-x-circle" viewBox = "0 0 16 16" >
                 <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                 <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                 </svg > `);
            $('.modal').modal('show');
        }
    }).fail(function (xhr, status, error) {
        console.log(error)
    });
}


$(document).ready(function () {
    $("button.Login").on('click', function (event) {
        event.preventDefault();
        User = $("input#inputUser").val()
        Rol = $("input.form-check-input:checked").val()
        Clave = $("input#inputClave").val()
        Ingresar(User, Rol, Clave)
    })
});