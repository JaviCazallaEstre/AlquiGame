$(function () {
  var datatable = $("#mytable").DataTable({
    ajax: {
      url: "http://www.alquigame.com:8000/alquileres/usuario",
      dataSrc: "",
    },
    columns: [
      { data: "juego" },
      { data: "fecha_inicio" },
      { data: "fecha_fin" },
      {
        data: "precio",
        render: function (data, type, row, meta) {
          var formatter = new Intl.NumberFormat("es-ES", {
            style: "currency",
            currency: "EUR",
          });

          return formatter.format(row.precio);
        },
      },
      { data: "fecha_devolucion" },
    ],
  });
});
