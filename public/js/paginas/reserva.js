function creaReserva(juego) {
  $.getJSON(
    "http://www.alquigame.com:8000/reservas/currentuserid",
    function (data) {
      modalReserva(data.user, juego);
    }
  ).fail(function (jqXHR) {
    if (jqXHR.status == 401) {
      alert("No puede realizar una reserva sin iniciar sesión.");
    } else {
      alert("Algo a ido mal, inténtelo de nuevo");
    }
  });

  jQuery.validator.addMethod(
    "notInThePast",
    function (value, element) {
      var curDate = new Date();
      curDate.setHours(0, 0, 0, 0);
      var inputDate = new Date(value);
      if (inputDate >= curDate) return true;
      return false;
    },
    "No puedes seleccionar una fecha pasada"
  ); // error message

  jQuery.validator.addMethod(
    "greaterThan",
    function (value, element, params) {
      if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) > new Date($(params).val());
      }

      return (
        (isNaN(value) && isNaN($(params).val())) ||
        Number(value) > Number($(params).val())
      );
    },
    "Debe ser mayor que {0}."
  );

  function modalReserva(idUsuario, juego) {
    $("#tituloJuego").text(juego.nombre);
    $("#plataformaJuego").text("Plataforma: " + juego.plataforma);
    var formatter = new Intl.NumberFormat("es-ES", {
      style: "currency",
      currency: "EUR",
    });

    precio = formatter.format(juego.precio);
    $("#precioJuego").text(precio);
    $("#modalReserva").modal("show");
    validarEntrada(juego);
    $("form[name='reservaForm']").submit(function (e) {
      e.preventDefault();
      $("#Alquilar").attr("disabled", true);

      var postData =
        $(this).serialize() +
        "&precio=" +
        precioTotal(juego) +
        "&juego=" +
        juego.id +
        "&usuario=" +
        idUsuario;

      $.post(
        "reservas",
        postData,
        function (response) {
          $(location).attr("href", "http://www.alquigame.com:8000/alquileres");
        },
        "JSON"
      );
    });
    $("#Alquilar").attr("disabled", true);
    $("form[name='reservaForm']").trigger("reset");
  }

  function validarEntrada(juego) {
    $("form[name='reservaForm']").bind("change keyup", function () {
      if (validarFormulario($("form[name='reservaForm']"))) {
        $("#Alquilar").attr("disabled", false);
        var formatter = new Intl.NumberFormat("es-ES", {
          style: "currency",
          currency: "EUR",
        });
        precio = formatter.format(precioTotal(juego));
        $("#totalPrecio").text(precio);
      } else {
        $("#Alquilar").attr("disabled", true);
        $("#totalPrecio").text("");
      }
    });
  }

  function precioTotal(juego) {
    var fechaInicio = new Date($("#fecha_inicio").val()).getTime();
    var fechaFin = new Date($("#fecha_fin").val()).getTime();
    var diff = fechaFin - fechaInicio;
    var dia = diff / (1000 * 60 * 60 * 24);
    return juego.precio * dia;
  }

  function validarFormulario(form) {
    return $(form)
      .validate({
        rules: {
          fecha_inicio: {
            required: true,
            notInThePast: true,
          },
          fecha_fin: {
            required: true,
            greaterThan: fecha_inicio,
          },
        },
        messages: {
          fecha_inicio: {
            required: "Debe rellenar este campo",
            notInThePast: "La fecha debe de ser minimo la de hoy",
          },
          fecha_fin: {
            required: "Debe rellenar este campo",
            greaterThan: "La fecha de fin debe de ser mayor que la de inicio",
          },
        },
      })
      .checkForm();
  }
}
