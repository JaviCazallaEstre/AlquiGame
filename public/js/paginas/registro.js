$(document).ready(function () {
  $("form[name='registration_form']").validate({
    rules: {
      'registration_form[email]': {
        required: true,
        email: true,
      },
      // nombre: "required",
      // apellidos: "required",
      // password: "required",
      // password2: "required",
    },
  });
  $("form[name='registration_form']").on("submit",function(ev){
    ev.preventDefault();
    console.log("hola")
  })
});
