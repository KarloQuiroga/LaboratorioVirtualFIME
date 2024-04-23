const Horas = $('span.Hora')
const Minutos = $('span.Minutos')
const Segundos = $('span.Segundos')
const Miliegundos = $('span.Miliegundos')

let interval
let hours = parseInt(Horas.text())
let minutes = parseInt(Minutos.text())
let seconds = parseInt(Segundos.text())
let milliseconds = 0


$(document).ready(function () {
    startTimer();
    Ingreso = HoraActual()
    console.log("Fecha y hora actual en el formato deseado: " + Ingreso);
    $(window).on('beforeunload', function () {
        // Muestra una alerta al usuario antes de cerrar la ventana
        Salida = HoraActual()
        GuardarTiempo(Ingreso, Salida)
    });
})

function HoraActual() {
    var fechaHoraActual = new Date();
    var año = fechaHoraActual.getFullYear();
    var mes = (fechaHoraActual.getMonth() + 1).toString().padStart(2, '0'); // Meses de 0 a 11, añadir 1
    var dia = fechaHoraActual.getDate().toString().padStart(2, '0');
    var hora = fechaHoraActual.getHours().toString().padStart(2, '0');
    var minutos = fechaHoraActual.getMinutes().toString().padStart(2, '0');
    var segundos = fechaHoraActual.getSeconds().toString().padStart(2, '0');
    // Formatear la fecha y hora en el formato deseado
    var Formato = año + '-' + mes + '-' + dia + ' ' + hora + ':' + minutos + ':' + segundos;
    return Formato
}

function startTimer() {
    setInterval(() => {
        milliseconds += 10
        if (milliseconds === 1000) {
            seconds++
            milliseconds = 0
        }
        if (seconds === 60) {
            minutes++
            seconds = 0
        }
        if (minutes === 60) {
            hours++
            minutes = 0
        }
        Horas.html(formatTime(hours))
        Minutos.html(formatTime(minutes))
        Segundos.html(formatTime(seconds))
    }, 10)
}


function formatTime(time) {
    return time < 10 ? `0${time}` : time
}

function GuardarTiempo(Inicio, Final) {
    var url = new URL(window.location.href);
    // Crea un objeto URLSearchParams para acceder a los parámetros de la URL
    var params = new URLSearchParams(url.search);
    // Obtiene el valor de un parámetro específico
    var Identificador = params.get('Res');
    $.ajax({
        url: "../static/php/GuardarTiempo.php",
        type: 'POST',
        data: {
            datos: JSON.stringify({
                Inicio: Inicio,
                Final: Final,
                Reservacion: Identificador
            })
        }
    }).done(function (response) {
        console.log(response)
    }).fail(function (xhr, status, error) {
        console.log(error)
    });
}
