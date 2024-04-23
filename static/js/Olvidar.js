$(document).ready(function () {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    // Evento de clic en el botón "Agregar"
    if (urlParams.get('Respuesta')) {
        $('.modal').modal('show');
    };
});