$(document).ready(function () {
  // Enviar email
  $('#btnSend').click(function (e) {
    e.preventDefault();
    
    $('.cardTo').hide(800);
    // cc = $('#ccHeader').val();
    let subject = $('#subject').val();
    let msg = getContent(1);

    if (subject == '' || subject == null || msg == '' || !msg) {
      toastr.error('Ingrese todos los campos');
      return false;
    }

    let support = $('#formSendSupport').serialize();
    support = support + '&message=' + msg;

    $.post(
      '../api/sendEmailSupport',
      support,
      function (data, textStatus, jqXHR) {
        message(data);
      }
    );
  });

  $('#btnSimSend').click(function (e) {
    e.preventDefault();

    $('.cardTo').show(800);
    let email = $('#to').val();
    let subject = $('#subject').val();
    let msg = getContent(1);

    if (email == '' || !email || subject == '' || subject == null || msg == '' || !msg) {
      toastr.error('Ingrese todos los campos');
      return false;
    }

    let support = $('#formSendSupport').serialize();
    support = support + '&email=' + email + '&message=' + msg;

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
