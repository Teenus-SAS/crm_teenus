$(document).ready(function () {
    let selectedFile;

    $('.cardImportSaleClients').hide();

    $('#btnNewImportSaleClients').click(function (e) {
        e.preventDefault();
        $('.cardImportSaleClients').toggle(800);
    });

    $('#fileSaleClient').change(function (e) {
        e.preventDefault();
        selectedFile = e.target.files[0];
    });

    $('#btnImportSaleClient').click(function (e) {
        e.preventDefault();
        file = $('#fileSaleClient').val();

        if (!file) {
            toastr.error('Seleccione un archivo');
            return false;
        }

        $('.cardBottons').hide();

        let form = document.getElementById('formSaleClients');
        form.insertAdjacentHTML(
            'beforeend',
            `<div class="col-sm-1 cardLoading">
        <div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>
      </div>`
        );

        importFile(selectedFile)
            .then((data) => {

                const expectedHeaders = ['nombres', 'apellidos', 'email'];
                const actualHeaders = Object.keys(data[0]);

                const missingHeaders = expectedHeaders.filter(header => !actualHeaders.includes(header));

                if (missingHeaders.length > 0) {
                    $('.cardLoading').remove();
                    $('.cardBottons').show(400);
                    $('#fileSaleClient').val('');
                    toastr.error('Archivo no corresponde con el formato. Verifique nuevamente');
                    return false;
                }

                let clientsToImport = data.map((item) => {
                    !item.nombres ? item.nombres = '' : item.nombres;
                    !item.apellidos ? item.apellidos = '' : item.apellidos;
                    !item.cargo ? item.cargo = '' : item.cargo;
                    !item.email ? item.email = '' : item.email;
                    !item.numero_celular ? item.numero_celular = '' : item.numero_celular;
                    !item.nombre_empresa ? item.nombre_empresa = '' : item.nombre_empresa;
                    !item.ventas ? item.ventas = '' : item.ventas;
                    !item.grupo ? item.grupo = '' : item.grupo;

                    return {
                        firstname: item.nombres,
                        lastname: item.apellidos,
                        position: item.cargo,
                        email: item.email,
                        cellphone: item.numero_celular,
                        company: item.nombre_empresa,
                        sales: item.ventas,
                        group: item.grupo,
                    };
                });
                checkSaleClients(clientsToImport);
            })
            .catch(() => {
                $('.cardLoading').remove();
                $('.cardBottons').show(400);
                $('#fileSaleClient').val('');
                toastr.error('Ocurrio un error. Intente Nuevamente');
            });
    });

    /* Mensaje de advertencia */
    const checkSaleClients = (data) => {
        $.ajax({
            type: 'POST',
            url: '/api/salesClientsDataValidation',
            data: { importClients: data },
            success: function (resp) {
                let arr = resp.import;

                if (arr.length > 0 && arr.error == true) {
                    $('.cardLoading').remove();
                    $('.cardBottons').show(400);
                    $('#fileSaleClient').val('');
                    toastr.error(resp.message);
                    $('#formImportSaleClients').trigger('reset');
                    return false;
                }

                if (resp.debugg.length > 0) {
                    $('.cardLoading').remove();
                    $('.cardBottons').show(400);
                    $('#fileSaleClient').val('');

                    // Generar el HTML para cada mensaje
                    let concatenatedMessages = resp.debugg.map(item =>
                        `<li>
                            <span class="badge text-danger" style="font-size: 16px;">${item.message}</span>
                        </li>`
                    ).join('');

                    // Mostramos el mensaje con Bootbox
                    bootbox.alert({
                        title: 'Estado Importación Data',
                        message: `
                            <div class="container">
                                <div class="col-12">
                                    <ul>
                                    ${concatenatedMessages}
                                    </ul>
                                </div> 
                            </div>`,
                        size: 'large',
                        backdrop: true
                    });
                    return false;
                }
        
                if (typeof arr === 'object' && !Array.isArray(arr) && arr !== null && resp.debugg.length == 0) {
                    bootbox.confirm({
                        title: '¿Desea continuar con la importación?',
                        message: `Se encontraron los siguientes registros:<br><br>Datos a insertar: ${arr.insert} <br>Datos a actualizar: ${arr.update}`,
                        buttons: {
                            confirm: {
                                label: 'Si',
                                className: 'btn-success',
                            },
                            cancel: {
                                label: 'No',
                                className: 'btn-danger',
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                saveSaleClientTable(data);
                            } else {
                                $('.cardLoading').remove();
                                $('.cardBottons').show(400);
                                $('#fileSaleClient').val('');
                            }
                        },
                    });
                }
            },
        });
    };

    /* Guardar Importacion */
    const saveSaleClientTable = (data) => {
        $.ajax({
            type: 'POST',
            url: '/api/addSaleClient',
            //data: data,
            data: { importClients: data },
            success: function (r) {
                $('.cardLoading').remove();
                $('.cardBottons').show(400);
                $('#fileSaleClient').val('');
                message(r);
            },
        });
    };

    /* Descargar formato */
    $('#btnDownloadImportsSaleClient').click(async function (e) {
        e.preventDefault();

        url = '/app/assets/formatsXlsx/Ventas_Clientes.xlsx';

        link = document.createElement('a');
        link.target = '_blank';

        link.href = url;
        document.body.appendChild(link);
        link.click();

        document.body.removeChild(link);
        delete link;
    });
 
});
