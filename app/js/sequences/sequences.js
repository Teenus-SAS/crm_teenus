$(document).ready(function () {
    /* Ocultar panel crear producto */
    $('.cardCreateSequence').hide();

    /* Abrir panel crear producto */
    $('#btnNewSequences').click(function (e) {
        e.preventDefault();
 
        $('.cardCreateSequence').toggle(800);
        $('#btnAddSequence').html('Crear');

        sessionStorage.removeItem('id_sequence');

        $('#sequence').val('');
    });

    /* Crear nuevo proceso */

    $('#btnAddSequence').click(function (e) {
        e.preventDefault();

        let idSequence = sessionStorage.getItem('id_sequence');

        if (idSequence == '' || idSequence == null) {
            checkDataSequence('/api/addSequence', idSequence);
        } else {
            checkDataSequence('/api/updateSequence', idSequence);
        }
    });

    /* Actualizar procesos */

    $(document).on('click', '.editSequence', function (e) {
        $('.cardCreateSequence').show(800);
        $('#btnAddSequence').html('Actualizar');
 
        let row = $(this).parent().parent()[0]
        let data = tableSequences.DataTable().row(row).data(); 

        sessionStorage.setItem('id_sequence', data.id_sequence);
        $('#sequence').val(data.name_sequence);

        $('html, body').animate(
            {
                scrollTop: 0,
            },
            1000
        );
    });

    /* Revision data procesos */
    const checkDataSequence = async (url, idSequence) => {
        let sequence = $('#sequence').val();

        if (sequence.trim() == '' || !sequence.trim()) {
            toastr.error('Ingrese todos los campos');
            return false;
        }

        let dataSequence = new FormData(formAddSequence);

        if (idSequence != '' || idSequence != null)
            dataSequence.append('idSequence', idSequence);

        let resp = await sendDataPOST(url, dataSequence);

        message(resp);
    };

    /* Eliminar proceso */

    deleteFunction = () => {
         let row = $(this.activeElement).parent().parent()[0];
        let data = tableSequences.DataTable().row(row).data();

        let id_sequence = data.id_sequence;

        bootbox.confirm({
            title: 'Eliminar',
            message:
                'Está seguro de eliminar esta secuencia? Esta acción no se puede reversar.',
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
                        `../../api/deleteSequence/${id_sequence}`,
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
        // if (data.reload) {
        //   location.reload(); 
    
        if (data.success == true) {
            $('.cardCreateSequence').hide(800);
            $('#formAddSequence').trigger('reset');
      
            updateTable();
            toastr.success(data.message);
            return false;
        } else if (data.error == true) toastr.error(data.message);
        else if (data.info == true) toastr.info(data.message);
    };
    
    function updateTable() {
        $('#tableSequences').DataTable().clear()
        $('#tableSequences').DataTable().ajax.reload()
    }
});
