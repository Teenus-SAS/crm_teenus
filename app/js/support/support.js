$(document).ready(function () {
  let chkGroup = [];

  $(document).on('click', '.checkboxGroup', function () {
    let op;
    
    $(`#${this.id}`).is(':checked') ? op = true : op = false;
    $(`#${this.id}`).prop('checked', op);
    
    if (this.id == 'all')
      $(`.checkboxGroup`).prop('checked', op);
  
    if (!$(`#${this.id}`).is(':checked')) {
      if (this.id == 'all') {
        for (i = 0; i < chkGroup.length; i++) {
          chkGroup.splice(i, 1);
        }
      } else
        if (this.id == 'all') {
          chkGroup = [];
          $(`#all`).prop('checked', op);
        }
        else
          for (let i = 0; i < chkGroup.length; i++) {
            if (chkGroup[i] == this.id) chkGroup.splice(i, 1);
          }
    } else {
      if (this.id == 'all')
        chkGroup = [];
      chkGroup.push(this.id);
    }
  });

  // Enviar email
  $('#btnSend').click(function (e) {
    e.preventDefault();
    
    $('.cardTo').hide(800);
    $('.cardSelectGroup').show(800);

    if (chkGroup.length == 0) {
      toastr.error('Seleccione un grupo');
      return false;
    }

    $('.loading').show(800);
    document.body.style.overflow = 'hidden';
    let ccHeader = $('#ccHeader').val();
    let subject = $('#subject').val();
    let content = $("#compose-editor").html();

    if (subject == '' || subject == null || content == '' || !content) {
      toastr.error('Ingrese todos los campos');
      $('.loading').hide(800);
      document.body.style.overflow = '';
      return false;
    }

    // Reemplaza &nbsp; con un espacio en blanco
    content = content.replace(/&nbsp;/g, '');

    // Opcional: Reemplaza cualquier espacio adicional por un solo espacio si es necesario
    content = content.replace(/\s+/g, ' ');

    let dataSupport = {};
    dataSupport['ccHeader'] = ccHeader;
    dataSupport['subject'] = subject;
    dataSupport['message'] = content;

    let group = chkGroup.toString();
    dataSupport['group'] = group;
     
    $.ajax({
      url: '/api/sendEmailSupport',
      type: 'POST',
      data: dataSupport,
      xhrFields: {
        onprogress: function (e) {
          // Obtener solo la última línea de respuesta
          const responses = e.target.responseText.split('}{').join('}|{').split('|');
          const latestResponse = responses[responses.length - 1];

          try {
            const progress = JSON.parse(latestResponse);
            $('#messageESP').text(progress.message);
          } catch (error) {
            console.error("Error al analizar el JSON:", error);
          }
        }
      },
      success: function (response) {
        // Obtener solo la última línea de respuesta
        const responses = response.split('}{').join('}|{').split('|');
        const latestResponse = responses[responses.length - 1];
        const resp = JSON.parse(latestResponse);
        
        if (resp.success) {
          message(resp);

          chkGroup = [];
          $(`.checkboxGroup`).prop('checked', false);

          $('.loading').hide(800);
          document.body.style.overflow = '';
        } else {
          toastr.error('Error: ' + `${resp.message}<br>Email: ${resp.email}`);
        }
      },
      error: function () {
        toastr.error('Error al enviar correos.');
      }
    });

  });

  $('#btnSimSend').click(function (e) {
    e.preventDefault();

    chkGroup = [];
    $(`.checkboxGroup`).prop('checked', false);
    $('.cardSelectGroup').hide(800); 
    
    $('.cardTo').show(800);
    let email = $('#to').val();
    let subject = $('#subject').val();
    let content = $("#compose-editor").html();

    if (email == '' || !email || subject == '' || subject == null || content == '' || !content) {
      toastr.error('Ingrese todos los campos');
      return false;
    }

    // Reemplaza &nbsp; con un espacio en blanco
    content = content.replace(/&nbsp;/g, '');

    // Opcional: Reemplaza cualquier espacio adicional por un solo espacio si es necesario
    content = content.replace(/\s+/g, ' ');

    let support = $('#formSendSupport').serialize();
    support = support + '&email=' + email + '&message=' + content;

    $.post(
      '../api/sendSimEmailSupport',
      support,
      function (data, textStatus, jqXHR) {
        message(data);
      }
    );
  });

  /* Mensaje de exito */

  message = (data) => {
    if (data.success == true) {
      $('#formSendSupport').trigger('reset');
      toastr.success(data.message);
      return false;
    } else if (data.error == true) toastr.error(data.message);
    else if (data.info == true) toastr.info(data.message);
  };
});
