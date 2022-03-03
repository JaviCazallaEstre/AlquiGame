$(function () {
  mostrarLoading()
  $.getJSON(
    "http://www.alquigame.com:8000/alquileres/usuario",
    function (data, textStatus, jqXHR) {
      htmlAlquiler = data.response;
      ocultarLoading()
      $("div.cuerpo").append(htmlAlquiler);
    }
  );
  function mostrarLoading() {
    $("div.cuerpo").append(
      '<div id="loading" class="col-12 loading"><img id="loading-image" src="../../img/ajax-loader.gif" alt="Loading..." /></div>'
    );
  }
  function ocultarLoading() {
    $("div#loading").hide();
  }
});
