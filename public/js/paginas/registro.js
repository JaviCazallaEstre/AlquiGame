$(document).ready(function () {
  // you may need to change this code if you are not using Bootstrap Datepicker
  $('#registration_form_fecha_nac').datepicker({
    format: "dd/mm/yyyy",
    language: 'es'
  });
  $("form[name='registration_form']").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      nombre: "required",
      apellidos: "required",
      password: "required",
      password2: "required",
    },
  });
});
