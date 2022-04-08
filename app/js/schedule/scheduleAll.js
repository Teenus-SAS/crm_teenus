$(document).ready(function() {

    let tableScheduleAll = $('#tableScheduleAll').dataTable({
        pageLength: 10,
        ajax: {
            url: '../../../api/schedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Comercial',
                data: 'asesor',
                className: 'uniqueClassName',
            },
            {
                title: 'Forma de Contacto',
                data: 'contact_form',
                className: 'uniqueClassName',
            },
            {
                title: 'Contacto',
                data: 'contact',
                className: 'uniqueClassName',
            },
            {
                title: 'Empresa',
                data: 'company_name',
                className: 'uniqueClassName',
            },
            {
                title: 'Descripción',
                data: 'description',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
                className: 'uniqueClassName',
            },
            /* {
                title: 'Estado',
                data: 'status',
                className: 'uniqueClassName',
                render: (data, type, row) => {
                    'use strict'
                    return data == 1 ? 'En progreso' : 'Terminada'
                },
            }, */
            {
                title: 'Acciones',
                data: 'id_schedule',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-edit updateSchedule" data-toggle='tooltip' title='Actualizar Actividad' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-x iconLink endSchedule" data-toggle='tooltip' title='Finalizar Actividad' style="font-size: 35px;"></i></a>`
                },
            },
        ],
    })


    tableCompletedTaskAll = $('#tableCompletedTaskAll').dataTable({
        pageLength: 10,
        ajax: {
            url: '../../../api/completedSchedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Comercial',
                data: 'asesor',
                className: 'uniqueClassName',
            },
            {
                title: 'Forma de Contacto',
                data: 'contact_form',
                className: 'uniqueClassName',
            },
            {
                title: 'Contacto',
                data: 'contact',
                className: 'uniqueClassName',
            },
            {
                title: 'Empresa',
                data: 'company_name',
                className: 'uniqueClassName',
            },
            {
                title: 'Descripción',
                data: 'description',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-check undoEndSchedule" data-toggle='tooltip' title='Activar Actividad' style="font-size: 35px;"></i></a>`
                },
            },
        ],
    })


    tableAlertTaskAll = $('#tableAlertTaskAll').dataTable({
        pageLength: 10,
        ajax: {
            url: '../../../api/todaySchedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Comercial',
                data: 'asesor',
                className: 'uniqueClassName',
            },
            {
                title: 'Forma de Contacto',
                data: 'contact_form',
                className: 'uniqueClassName',
            },
            {
                title: 'Contacto',
                data: 'contact',
                className: 'uniqueClassName',
            },
            {
                title: 'Empresa',
                data: 'company_name',
                className: 'uniqueClassName',
            },
            {
                title: 'Descripción',
                data: 'description',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-check undoEndSchedule" data-toggle='tooltip' title='Activar Actividad' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-x iconLink endSchedule" data-toggle='tooltip' title='Finalizar Actividad' style="font-size: 35px;"></i></a>`

                },
            },
        ],
    })


    tableDelayTaskAll = $('#tableDelayTaskAll').dataTable({
        pageLength: 10,
        ajax: {
            url: '../../../api/delaySchedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Comercial',
                data: 'asesor',
                className: 'uniqueClassName',
            },
            {
                title: 'Forma de Contacto',
                data: 'contact_form',
                className: 'uniqueClassName',
            },
            {
                title: 'Contacto',
                data: 'contact',
                className: 'uniqueClassName',
            },
            {
                title: 'Empresa',
                data: 'company_name',
                className: 'uniqueClassName',
            },
            {
                title: 'Descripción',
                data: 'description',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-check undoEndSchedule" data-toggle='tooltip' title='Activar Actividad' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-x iconLink endSchedule" data-toggle='tooltip' title='Finalizar Actividad' style="font-size: 35px;"></i></a>`

                },
            },
        ],
    })
})

/* Actualizar tabla */

function updateTable() {
    $('#tableScheduleAll').DataTable().clear()
    $('#tableScheduleAll').DataTable().ajax.reload()

    $('#tableCompletedTaskAll').DataTable().clear()
    $('#tableCompletedTaskAll').DataTable().ajax.reload()

    $('#tableAlertTaskAll').DataTable().clear()
    $('#tableAlertTaskAll').DataTable().ajax.reload()

    $('#tableDelayTaskAll').DataTable().clear()
    $('#tableDelayTaskAll').DataTable().ajax.reload()
}