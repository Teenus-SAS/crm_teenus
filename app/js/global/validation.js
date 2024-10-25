/* Validacion inputs */

;(function () {
  'use strict'
  window.addEventListener(
    'load',
    function () {
      var forms = document.getElementsByClassName('needs-validation')
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          'submit',
          function (event) {
            event.preventDefault()
            event.stopPropagation()
            if (form.checkValidity()) {
              enviarData()
            }
            form.classList.add('was-validated')
          },
          false,
        )
      })
    },
    false,
  )
})()

function enviarData() {
  saveContact()
}
