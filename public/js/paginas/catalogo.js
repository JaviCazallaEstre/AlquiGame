$(function () {
  var contenedorMemoria = $("<div>");
  var allJuegos = [];
  var filtrosRangoEdad = [];
  var filtrosGenero = [];
  var filtrosPlataforma = [];
  var filtrosDesarrolladora = [];
  var orden = "precioMenor";

  //Funcion que guarda la pantalla de articulos en el contenedor
  function guardarProductos() {
    contenedorMemoria.append($("div.cuerpo").children());
  }

  //Funcion que restura los articulos del contenedor
  function restaurarProductos() {
    $("div.cuerpo").empty().append(contenedorMemoria.children());
  }

  var contenedor = $("<div>").load(
    "../../html/plantillaCatalogo.html",
    function () {
      contenedor.addClass("container py-5");
      contenedor.appendTo("div.cuerpo");
    }
  );
  $.getJSON("api/plataformas", function (data, textStatus, jqXHR) {
    console.log(data);
  });

  var plantillaJuego = $("<div>").load(
    "../../html/plantillaJuego.html",
    function () {
      cargarInformacion();
    }
  );

  async function cargarInformacion() {
    let fetchURL = (url) => fetch(url).then((r) => r.json());
    let fetchURLHydraMember = (url) =>
      fetchURL(url).then((r) => r["hydra:member"]);

    mostrarLoading();

    let [generos, plataformas, rangoEdades, desarrolladoras, juegos] =
      await Promise.all([
        fetchURLHydraMember("api/generos"),
        fetchURLHydraMember("api/plataformas"),
        fetchURLHydraMember("api/rango_edads"),
        fetchURLHydraMember("api/desarrolladoras"),
        fetchURL("http://www.alquigame.com:8000/catalogo/get"),
      ]);

    ocultarLoading();

    mostrarFiltroGeneros(generos);
    mostrarFiltroPlataformas(plataformas);
    mostrarFiltroRangoEdades(rangoEdades);
    mostrarFiltroDesarrolladoras(desarrolladoras);
    allJuegos = juegos;
    juegos.sort(function (a, b) {
      return a.nombre.localeCompare(b.nombre);
    });
    mostrarJuegos(juegos);
  }

  function mostrarLoading() {
    $("div.cuerpo").append(
      '<div id="loading" class="col-12 loading"><img id="loading-image" src="../../img/ajax-loader.gif" alt="Loading..." /></div>'
    );
  }

  function ocultarLoading() {
    $("div#loading").hide();
  }

  function mostrarJuegos(juegos) {
    $(juegos).each(function (i, value) {
      var contenedorJuego = $(plantillaJuego).clone();
      contenedorJuego.find(".nombre").text(value.nombre);
      contenedorJuego.find(".foto").attr("src", "img/juego/" + value.foto);
      contenedorJuego.find(".plataforma").text(value.plataforma);
      contenedorJuego.find(".precio").text(value.precio + ".00 €");
      contenedorJuego.find(".detalles").on("click", function (ev) {
        ev.preventDefault();
        mostrarDetalles(value.id);
      });
      contenedorJuego.find("a:last").on("click", function () {});
      contenedorJuego.addClass("col-md-4");
      contenedorJuego.appendTo("div.contenedorjuegos");
    });
  }

  function mostrarFiltroGeneros(generos) {
    mostrarTituloOpcionFiltro("Género");
    generos.forEach((genero) => {
      let id = "genero_" + genero.id.toString();
      mostrarOpcionFiltro(genero.nombre, id);
      $("#" + id).change(function () {
        if (this.checked) {
          filtrosGenero.push(genero.id);
        } else {
          filtrosGenero = filtrosGenero.filter(
            (idGenero) => idGenero != genero.id
          );
        }

        recargarJuegosFiltrados();
      });
    });
  }

  function mostrarFiltroDesarrolladoras(desarrolladoras) {
    mostrarTituloOpcionFiltro("Desarrolladora");
    desarrolladoras.forEach((desarrolladora) => {
      let id = "desarrolladora_" + desarrolladora.id.toString();
      mostrarOpcionFiltro(desarrolladora.nombre, id);
      $("#" + id).change(function () {
        if (this.checked) {
          filtrosDesarrolladora.push(desarrolladora.id);
        } else {
          filtrosDesarrolladora = filtrosDesarrolladora.filter(
            (idDesarrolladora) => idDesarrolladora != desarrolladora.id
          );
        }

        recargarJuegosFiltrados();
      });
    });
  }

  function mostrarFiltroPlataformas(plataformas) {
    mostrarTituloOpcionFiltro("Plataforma");
    plataformas.forEach((plataforma) => {
      let id = "plataforma_" + plataforma.id.toString();
      mostrarOpcionFiltro(plataforma.nombre, id);
      $("#" + id).change(function () {
        if (this.checked) {
          filtrosPlataforma.push(plataforma.id);
        } else {
          filtrosPlataforma = filtrosPlataforma.filter(
            (idPlataforma) => idPlataforma != plataforma.id
          );
        }

        recargarJuegosFiltrados();
      });
    });
  }

  function mostrarFiltroRangoEdades(rangoEdades) {
    mostrarTituloOpcionFiltro("Rango Edad");
    rangoEdades.forEach((rangoEdad) => {
      let id = "rangoEdad_" + rangoEdad.id.toString();
      mostrarOpcionFiltro(rangoEdad.edad, id);
      $("#" + id).change(function () {
        if (this.checked) {
          filtrosRangoEdad.push(rangoEdad.id);
        } else {
          filtrosRangoEdad = filtrosRangoEdad.filter(
            (idRangoEdad) => idRangoEdad != rangoEdad.id
          );
        }

        recargarJuegosFiltrados();
      });
    });
  }

  function mostrarTituloOpcionFiltro(nombre) {
    $(".contenedorCategorias").append(
      '<h3 class="d-flex justify-content-between h3">' + nombre + "</h3>"
    );
  }

  function mostrarOpcionFiltro(nombre, id) {
    $(".contenedorCategorias").append(
      '<input class="form-check-input" type="checkbox" id="' +
        id +
        '" name="' +
        nombre +
        '" value="' +
        nombre +
        '"' +
        '<label for="' +
        nombre +
        '">  ' +
        nombre +
        "</label><br />"
    );
  }

  function mostrarDetalles(id) {
    $.getJSON(
      "http://www.alquigame.com:8000/catalogo/juego/" + id,
      function (data, textStatus, jqXHR) {
        juego = data.response;
        guardarProductos();
        $("div.cuerpo").append(juego);
        $("button[id=volver]").on("click", function (ev) {
          ev.preventDefault();
          restaurarProductos();
        });
      }
    );
  }

  function recargarJuegosFiltrados() {
    let juegosFiltrados = allJuegos.filter((juego) => {
      return (
        cumpleFiltroRangoEdad(juego) &&
        cumpleFiltroPlataforma(juego) &&
        cumpleFiltroDesarrolladora(juego) &&
        cumpleFiltroGenero(juego)
      );
    });

    juegosFiltrados.sort(function (a, b) {
      if (orden == "alfabetico") {
        return a.nombre.localeCompare(b.nombre);
      } else if (orden == "precioMenor") {
        return parseFloat(a.precio) - parseFloat(b.precio);
      } else if (orden == "precioMayor") {
        return parseFloat(b.precio) - parseFloat(a.precio);
      }
    });

    $("div.contenedorjuegos").empty();

    mostrarJuegos(juegosFiltrados);
  }

  function cumpleFiltroRangoEdad(juego) {
    if (filtrosRangoEdad.length == 0) {
      return true;
    } else {
      return filtrosRangoEdad.includes(juego.idRangoEdad);
    }
  }

  function cumpleFiltroPlataforma(juego) {
    if (filtrosPlataforma.length == 0) {
      return true;
    } else {
      return filtrosPlataforma.includes(juego.idPlataforma);
    }
  }

  function cumpleFiltroDesarrolladora(juego) {
    if (filtrosDesarrolladora.length == 0) {
      return true;
    } else {
      return filtrosDesarrolladora.includes(juego.idDesarrolladora);
    }
  }

  function cumpleFiltroGenero(juego) {
    if (filtrosGenero.length == 0) {
      return true;
    } else {
      var cumpleFiltroGenero = false;
      let idsGenerosJuego = JSON.parse(juego.idsGeneros);
      idsGenerosJuego.forEach((idGenero) => {
        if (filtrosGenero.includes(idGenero)) {
          cumpleFiltroGenero = true;
        }
      });
      return cumpleFiltroGenero;
    }
  }
});
