$(document).ready(function () {
    /* Abrir panel crear producto */
    $('#btnNewSaleClients').click(function (e) {
        e.preventDefault();

        // $('.cardImportProcess').hide(800);
        $('#modalSalesClients').modal('show');
        $('#formAddSaleClient').trigger('reset');
        sessionStorage.removeItem('id_sale_client');
    });

    /* Crear nuevo proceso */

    $('#btnAddSaleClient').click(function (e) {
        e.preventDefault();

        let idSaleClient = sessionStorage.getItem('id_sale_client');

        if (idSaleClient == '' || idSaleClient == null) {
            checkDataSaleClient('/api/addSaleClient', idSaleClient);
        } else {
            checkDataSaleClient('/api/updateSaleClient', idSaleClient);
        }
    });

    /* Actualizar procesos */

    $(document).on('click', '.editSaleClient', function (e) {
        // $('.cardImportProcess').hide(800);
        $('#modalSalesClients').modal('show');

        let row = $(this).parent().parent()[0];
        let data = tableSalesClients.fnGetData(row);
        sessionStorage.setItem('id_sale_client', data.id_sale_client);

        $('#firstname').val(data.firstname);
        $('#lastname').val(data.lastname);
        $('#position').val(data.position);
        $('#email').val(data.email);
        $('#cellphone').val(data.cellphone);
        $('#company').val(data.company); 
        $('#sales').val(data.sales);

        $('html, body').animate(
            {
                scrollTop: 0,
            },
            1000
        );
    });

    /* Revision data procesos */
    const checkDataSaleClient = async (url, idSaleClient) => {
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let email = $('#email').val();

        if (
            firstname.trim() == '' || !firstname.trim() ||
            lastname.trim() == '' || !lastname.trim() ||
            email.trim() == '' || !email.trim()
        ) {
            toastr.error('Ingrese todos los campos');
            return false;
        }

        let dataClient = new FormData(formAddSaleClient);

        if (idSaleClient)
            dataClient.append('idSaleClient', idSaleClient);

        let resp = await sendDataPOST(url, dataClient); 
        message(resp);
    };

    /* Eliminar proceso */

    deleteFunction = () => {
        let row = $(this.activeElement).parent().parent()[0];
        let data = tableSalesClients.fnGetData(row); 

        let id_sale_client = data.id_sale_client;

        bootbox.confirm({
            title: 'Eliminar',
            message:
                'Está seguro de eliminar este cliente? Esta acción no se puede reversar.',
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
                if (result == true) {
                    $.get(
                        `/api/deleteSaleClient/${id_sale_client}`,
                        function (data, textStatus, jqXHR) {
                            message(data);
                        }
                    );
                }
            },
        });
    }; 

    /* Mensaje de exito */
    message = (data) => {
        $('.cardLoading').remove();
        $('.cardBottons').show(400);
        $('#fileProcess').val('');
    
        if (data.success == true) {
            // $('.cardImportProcess').hide(800);
            // $('#formImportProcess').trigger('reset');
            $('#modalSalesClients').modal('hide');
            $('#formAddSaleClient').trigger('reset');
            updateTable();
            toastr.success(data.message);
            return false;
        } else if (data.error == true) toastr.error(data.message);
        else if (data.info == true) toastr.info(data.message);
    };

    function updateTable() {
        $('#tableSalesClients').DataTable().clear();
        $('#tableSalesClients').DataTable().ajax.reload();
    }
});
