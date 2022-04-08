/* Crear años para selects */
$(document).ready(function() {
    let n = (new Date()).getFullYear()
    let select = document.getElementById("year");

    for (var i = n; i <= (n + 5); i++)
        select.options.add(new Option(i, i));

});