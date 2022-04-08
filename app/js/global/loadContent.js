function cargarContenido(contenedor, contenido) {
    $(`.${contenedor}`).load(contenido)
}

$(document).ready(function() {
    $("#menu li").click(function(event) {
        // check if window is small enough so dropdown is created
        $("#nav-collapse").removeClass("in").addClass("collapse");
    });
});