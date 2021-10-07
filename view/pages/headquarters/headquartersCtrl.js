function headquartersCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "seat.php",
      type: "GET",
      headers: {
        accion: "listar",
        token: createToken(getToken()),
      },
    },
    columns: [
      {
        data: "status",
        render: function (data) {
          return (
            (data == 1
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar sede"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar sede"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar sede"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "country" },
      { data: "city" },
      { data: "name" },
      {
        data: "status",
        render: function (data) {
          return data == 1 ? "Activo" : "Inactivo";
        },
      },
      {
        data: "created_at",
        render: function (data) {
          return moment(data).format("DD-MM-yyyy");
        },
      },
      {
        data: "updated_at",
        render: function (data) {
          return moment(data).format("DD-MM-yyyy");
        },
      },
    ],
  });

  $(".card").on("click", ".nuevo", function () {
    $(this).hide();
    $("#listado_wrapper").hide();
    $(".card-title").html("Crear sede");
    $("#formSave").load("./headquarters/nuevo.php", function () {
      getCountries();
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (!form[0].name.value || !form[0].country_id.value || !form[0].city_id.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "seat.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Sede agregada con exito");
        else toastr.error("Error al agregar la sede");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".editar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $(".nuevo").hide();
    $("#listado_wrapper").hide();
    $(".card-title").html("Actualizar sede");
    $("#formSave").load("./headquarters/editar.php", function () {
      getCountries(data.country_id);
      getCities(data.country_id, data.city_id);
      $("#alert").hide();
      $("#id").val(data.id);
      $("#name").val(data.name);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (!form[0].name.value || !form[0].country_id.value || !form[0].city_id.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "seat.php",
        type: "PUT",
        headers: {
          accion: "modificar",
          token: createToken(getToken()),
        },
        data: JSON.stringify(getFormData(form)),
        contentType: "application/json",
      }).done(function (response) {
        if (response == 1) toastr.success("Sede actualizada con exito");
        else toastr.error("Error al actualizar la sede");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "seat.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Sede desactivada con exito");
      else toastr.error("Error al desactivar la sede");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "seat.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Sede activado con exito");
      else toastr.error("Error al activar la sede");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $(".card").on("change", "#country_id", function (e) {
    e.preventDefault();
    getCities($(this).val());
  });

  $(".card").on("click", "#close", function () {
    volver();
  });

  const volver = () => {
    $(".nuevo").show();
    $("#listado_wrapper").show();
    $(".card-title").html("Listado de sedes");
    $("#formSave").html("");
  };

  const getCountries = (id) => {
    $.ajax({
      url: BASE_URL + "seat.php",
      type: "GET",
      headers: {
        accion: "listarCountries",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#country_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#country_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };

  const getCities = (country_id, id) => {
    $.ajax({
      url: BASE_URL + "seat.php",
      type: "GET",
      headers: {
        accion: "listarCities",
        token: createToken(getToken()),
      },
      data: { country_id: country_id },
    }).done(function (response) {
      $("#city_id").html("");
      $("#city_id").append('<option value="">Seleccione una ciudad...</option>');
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#city_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#city_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };
}
