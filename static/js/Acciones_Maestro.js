$(document).ready(function () {
    // Evento de clic en el botón "Agregar"
    $("input.subirlista").on('click', function (event) {
        event.preventDefault();
        $('.modalAgregar').modal('show');
    });
});


