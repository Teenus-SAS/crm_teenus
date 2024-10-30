$(document).ready(function() {
    tableSchedule = $('#tableSchedule').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/schedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
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
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-350'>" + data + "</div>";
                },
            },
            {
                title: 'Asesor Comercial',
                data: 'asesor',
                visible: tipo == '1',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                visible: tipo !== '1',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-edit updateSchedule" data-toggle='tooltip' title='Actualizar Actividad' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-x iconLink endSchedule" data-toggle='tooltip' title='Finalizar Actividad' style="font-size: 35px;"></i></a>`
                },
            },
        ],
    })



    tableCompletedTask = $('#tableCompletedTask').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/completedSchedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
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
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-350'>" + data + "</div>";
                },
            },
            {
                title: 'Asesor Comercial',
                data: 'asesor',
                visible: tipo == '1',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                visible: tipo !== '1',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-check undoEndSchedule" data-toggle='tooltip' title='Activar Actividad' style="font-size: 35px;"></i></a>`
                },
            },
        ],
    })


    tableAlertTask = $('#tableAlertTask').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/todaySchedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
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
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-350'>" + data + "</div>";
                },
            },
            {
                title: 'Asesor Comercial',
                data: 'asesor',
                visible: tipo == '1',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                visible: tipo !== '1',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-edit updateSchedule" data-toggle='tooltip' title='Actualizar Actividad' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-x iconLink endSchedule" data-toggle='tooltip' title='Finalizar Actividad' style="font-size: 35px;"></i></a>`

                },
            },
        ],
    })


    tableDelayTask = $('#tableDelayTask').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/delaySchedules',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                data: null,
                className: 'uniqueClassName',
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Fecha Acción',
                data: 'due_date',
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
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-350'>" + data + "</div>";
                },
            },
            {
                title: 'Asesor Comercial',
                data: 'asesor',
                visible: tipo == '1',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_schedule',
                visible: tipo !== '1',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-edit updateSchedule" data-toggle='tooltip' title='Actualizar Actividad' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-calendar-x iconLink endSchedule" data-toggle='tooltip' title='Finalizar Actividad' style="font-size: 35px;"></i></a>`

                },
            },
        ],
    })
})