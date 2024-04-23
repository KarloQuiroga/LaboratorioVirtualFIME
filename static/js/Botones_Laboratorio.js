$(document).ready(function () {
    // Evento de clic en el botón "Agregar"
    $("input.add2").on('click', function (event) {
        event.preventDefault();
        $('.modalAgregar').modal('show');
    });
});

