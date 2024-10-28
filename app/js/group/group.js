$(document).ready(function () {
    $('.cardCreateGroup').hide();

    /* Abrir panel crear producto */
    $('#btnNewGroup').click(function (e) {
        e.preventDefault();

        // $('.cardImportSaleClients').hide(800);
        $('.cardCreateGroup').toggle(800);
        $('#btnAddGroup').html('Crear');
        $('#formAddGroup').trigger('reset');
        sessionStorage.removeItem('id_group');
    });

    /* Crear nuevo proceso */

    $('#btnAddGroup').click(function (e) {
        e.preventDefault();

        let idGroup = sessionStorage.getItem('id_group');

        if (idGroup == '' || idGroup == null) {
            checkDataGroup('/api/addGroup', idGroup);
        } else {
            checkDataGroup('/api/updateGroup', idGroup);
        }
    });

    /* Actualizar procesos */

    $(document).on('click', '.editGroup', function (e) { 
        $('.cardCreateGroup').show(800);
        $('#btnAddGroup').html('Actualizar');

        let row = $(this).parent().parent()[0];
        let data = tableGroups.fnGetData(row);
        sessionStorage.setItem('id_group', data.id_group);

        $('#group').val(data.name_group);

        $('html, body').animate(
            {
                scrollTop: 0,
            },
            1000
        );
    });

    /* Revision data procesos */
    const checkDataGroup = async (url, idGroup) => {
        let group = $('#group').val();

        if (
            group.trim() == '' || !group.trim()
        ) {
            toastr.error('Ingrese todos los campos');
            return false;
        }

        let dataGroup = new FormData(formAddGroup);

        if (idGroup)
            dataGroup.append('idGroup', idGroup);

        let resp = await sendDataPOST(url, dataGroup);
        messageGroup(resp);
    };

    /* Eliminar proceso */

    deleteGRFunction = () => {
        let row = $(this.activeElement).parent().parent()[0];
        let data = tableGroups.fnGetData(row);

        let id_group = data.id_group;

        bootbox.confirm({
            title: 'Eliminar',
            message:
                'Está seguro de eliminar este grupo? Esta acción no se puede reversar.',
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
                        `/api/deleteGRoup/${id_group}`,
                        function (data, textStatus, jqXHR) {
                            messageGroup(data);
                        }
                    );
                }
            },
        });
    };

    /* Mensaje de exito */
    const messageGroup = (data) => {
        // $('.cardLoading').remove();
        // $('.cardBottons').show(400);
        // $('#fileSaleClient').val('');
    
        if (data.success == true) {
            // $('.cardImportSaleClients').hide(800);
            // $('#formImportSaleClients').trigger('reset');
            $('.cardCreateGroup').hide(800);
            $('#formAddGroup').trigger('reset');
            loadAllDataGroups();
            toastr.success(data.message);
            return false;
        } else if (data.error == true) toastr.error(data.message);
        else if (data.info == true) toastr.info(data.message);
    };
 
});
