$(document).ready(function () {
  // Enviar email
  $('#btnSend').click(function (e) {
    e.preventDefault();
    
    $('.cardSelectGroup').show(800); 

    let group = $('#slctGroup').val();
    
    !group || group == '' ? group = 0 : group;

    // if (!group || group == '') {
    //   toastr.error('Seleccione un grupo');
    //   return false;
    // }

    $('.loading').show(800); 
    document.body.style.overflow = 'hidden';
    $('.cardTo').hide(800);
    // cc = $('#ccHeader').val();
    let subject = $('#subject').val();
    let content = $("#compose-editor").html();

    if (subject == '' || subject == null || content == '' || !content) {
      toastr.error('Ingrese todos los campos');
      $('.loading').hide(800);
      document.body.style.overflow = '';
      return false;
    }

    let support = $('#formSendSupport').serialize();
    support = support + '&idGroup=' + group + '&message=' + content;

    $.post(
      '../api/sendEmailSupport',
      support,
      function (data, textStatus, jqXHR) {
        message(data);
        $('.loading').hide(800);
        document.body.style.overflow = '';
      }
    );
  });

  $('#btnSimSend').click(function (e) {
    e.preventDefault();

    $('.cardSelectGroup').hide(800); 
    
    $('.cardTo').show(800);
    let email = $('#to').val();
    let subject = $('#subject').val();
    let content = $("#compose-editor").html();

    if (email == '' || !email || subject == '' || subject == null || content == '' || !content) {
      toastr.error('Ingrese todos los campos');
      return false;
    }

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
