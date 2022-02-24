$(document).ready(function () {
  $("form[name='registration_form']").validate({
    rules: {
      'registration_form[email]': {
        required: true,
        email: true,
      },
      'registration_form[nombre]':{
        required: true
      },
      'registration_form[apellidos]':{
        required: true
      },
      'registration_form[fecha_nac]':{
        required: true,
        dateIso: true
      },
      'registration_form[agreeTerms]':{
        required: true
      },
      "registration_form[plainPassword][first]":{
        required: true
      },
      "registration_form[plainPassword][second]":{
        required: true,
        equalTo: "registration_form[plainPassword][first]"
      },
      "registration_form[foto]":{
        required: false,
        extension: "jpg|jpeg|png"
      }
    },
    messages :{
      'registration_form[email]':{
        required: "El campo de email debe de estar relleno",
        email: "El formato de email no es vádido debe de ser abc@domain.com"
      },
      'registration_form[nombre]':{
        required: "El campo de nombre debe de estar relleno"
      },
      'registration_form[apellidos]':{
        required: "El campo de apellidos debe de estar relleno"
      },
      'registration_form[fecha_nac]':{
        required: "La fecha no puede estar vacía"
      },
      'registration_form[agreeTerms]':{
        required: "Debes de aceptar los términos"
      },
      "registration_form[plainPassword][first]":{
        required: "La contraseña debe de estar rellena"
      },
      "registration_form[plainPassword][second]":{
        required: "El campo de confimar contraseña debe de estar relleno",
        equalTo: "Las contraseñas no coinciden"
      },
      "registration_form[foto]" :{
        extension: "El archivo debe de ser una foto .png, jpg, jpeg"
      }
    }
  });
  $("form[name='registration_form']").on("submit",function(ev){
    ev.preventDefault();

  })
});
