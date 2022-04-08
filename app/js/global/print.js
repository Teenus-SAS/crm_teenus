$('#btnImprimirQuote').click(function(e) {
    e.preventDefault();
    window.print();
});

/* let print = (doc) => {
    let objFra = document.createElement('iframe'); // Create an IFrame.
    objFra.style.visibility = 'hidden'; // Hide the frame.
    objFra.src = doc; // Set source.
    document.body.appendChild(objFra); // Add the frame to the web page.
    objFra.contentWindow.focus(); // Set focus.
    objFra.contentWindow.print(); // Print it.
} */

/* let print = (doc) => {
    
    var ficha = document.getElementById(doc);
    var ventimp = window.open(' ', 'popimpr');

    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();
    ventimp.print();
    ventimp.close();

} */