$(document).ready(function () {
  $('#zonesAssigned').toggle();

  $('#btnNewZoneAssigned').click(function (e) {
    e.preventDefault();
    $('#zonesAssigned').toggle(500);
  });

  /* Cargue tabla de usuarios */

  tableZonesAssigned = $('#tableZonesAssigned').dataTable({
    pageLength: 10,
    ajax: {
      url: '../../../api/zonesAssigned',
      dataSrc: '',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'No.',
        data: null,
        className: 'uniqueClassName',
        render: function (data, type, full, meta) {
          return meta.row + 1;
        },
      },
      {
        title: 'Zonas',
        data: 'zone',
        className: 'uniqueClassName',
      },
      {
        title: 'Asesor Comercial',
        data: 'asesor',
        className: 'uniqueClassName',
      },
      {
        title: 'Acciones',
        data: 'id_users_zone',
        render: function (data) {
          return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt editZoneAssigned" data-toggle='tooltip' title='Editar Asignación de Zona' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteZoneAssigned" data-toggle='tooltip' title='Eliminar Asignación de Zona' style="font-size: 35px;color:red"></i></a>`;
        },
      },
    ],
  });

  /* Create new assigned zone */

  $('#btnCreateZoneAssigned').click(function (e) {
    e.preventDefault();

    let data = $('#formAssignedZone').serialize();
    $.ajax({
      type: 'POST',
      url: '../../../api/addZonesAssigned',
      data: data,

      success: function (response, jqXHR, statusCode) {
        $('#zones').toggle(1000);

        updateTable();
        if (response.success == true) toastr.success(response.message);
        if (response.error == true) toastr.error(response.message);
        if (response.info == true) toastr.info(response.message);
      },
    });
  });

  /* Actualizacion Usuario */

  $(document).on('click', '.editZoneAssigned', function (e) {
    e.preventDefault();

    let id = $(this).prop('id');
    let row = $(this).parent().parent()[0];
    let data = tableZonesAssigned.fnGetData(row);

    $('#zonesAssigned').show('500');

    $('#id_assignedZone').val(id);
    $(`.selectSeller option:contains(${data.asesor})`).prop('selected', true);
    $(`.selectZone option:contains(${data.zone})`).prop('selected', true);

    $('#btnCreateUser').html('Actualizar Usuario');
  });

  /* Eliminar Usuario */

  $(document).on('click', '.deleteZoneAssigned', function (e) {
    e.preventDefault();

    let id = $(this).prop('id');
    let row = $(this).parent().parent()[0];
    let data = tableZonesAssigned.fnGetData(row);

    alertify.confirm(
      'teenus',
      `¿Realmente desea <b style="color:red">eliminar</b> la asignación de la <b style="color:red">zona ${data.zone}</b> para el asesor(a) <b style="color:red">${data.asesor}</b>?`,
      function () {
        $.ajax({
          url: `../api/deleteZonesAssigned/${id}`,

          success: function (r) {
            updateTable();
            if (response.success == true) toastr.success(response.message);
            if (response.error == true) toastr.error(response.message);
            if (response.info == true) toastr.info(response.message);
          },
        });
      },
      function () {
        alertify.error('Cancel');
      }
    );
  });

  /* Actualizar tabla */

  function updateTable() {
    $('#tableZonesAssigned').DataTable().clear();
    $('#tableZonesAssigned').DataTable().ajax.reload();
  }
});
