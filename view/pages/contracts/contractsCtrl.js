function contractsCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "contract.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar contrato"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar contrato"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar contrato"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "id" },
      { data: "type_contract" },
      { data: "no_document" },
      { data: "employe" },
      { data: "profession" },
      {
        data: "salary",
        render: function (data) {
          return "$ " + new Intl.NumberFormat("de-DE").format(data);
        },
      },
      {
        data: "date_init",
        render: function (data) {
          return moment(data).format("DD-MM-yyyy");
        },
      },
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
    $(".card-title").html("Crear contrato");
    $("#formSave").load("./contracts/nuevo.php", function () {
      getTypesContracts();
      getCountries();
      getProfessions();
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].type_contract_id.value ||
      !form[0].country_id.value ||
      !form[0].city_id.value ||
      !form[0].seat_id.value ||
      !form[0].employe_id.value ||
      !form[0].profession_id.value ||
      !form[0].date_init.value ||
      !form[0].salary.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "contract.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Contrato agregado con exito");
        else if (response == 2)
          toastr.info("Empleado ya con un contrato vigente");
        else toastr.error("Error al agregar el contrato");
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
    $(".card-title").html("Actualizar contrato");
    $("#formSave").load("./contracts/editar.php", function () {
      getTypesContracts(data.type_contract_id);
      getCountries(data.country_id);
      getCities(data.country_id, data.city_id);
      getHeadquarters(data.city_id, data.seat_id);
      getEmployees(data.seat_id, data.employe_id);
      getProfessions(data.profession_id);
      $("#alert").hide();
      $("#id").val(data.id);
      $("#date_init").val(data.date_init);
      $("#date_end").val(data.date_end);
      $("#duration").val(data.duration);
      $("#salary").val(data.salary);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (
      !form[0].type_contract_id.value ||
      !form[0].country_id.value ||
      !form[0].city_id.value ||
      !form[0].seat_id.value ||
      !form[0].employe_id.value ||
      !form[0].profession_id.value ||
      !form[0].date_init.value ||
      !form[0].salary.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "contract.php",
        type: "PUT",
        headers: {
          accion: "modificar",
          token: createToken(getToken()),
        },
        data: JSON.stringify(getFormData(form)),
        contentType: "application/json",
      }).done(function (response) {
        if (response == 1) toastr.success("Contrato actualizado con exito");
        else toastr.error("Error al actualizar el contrato");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "contract.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Contrato desactivado con exito");
      else toastr.error("Error al desactivar el contrato");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "contract.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Contrato activado con exito");
      else toastr.error("Error al activar el contrato");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $(".card").on("change", "#country_id", function (e) {
    e.preventDefault();
    getCities($(this).val());
  });

  $(".card").on("change", "#city_id", function (e) {
    e.preventDefault();
    getHeadquarters($(this).val());
  });

  $(".card").on("change", "#seat_id", function (e) {
    e.preventDefault();
    getEmployees($(this).val());
  });

  $(".card").on("click", "#close", function () {
    volver();
  });

  const volver = () => {
    $(".nuevo").show();
    $("#listado_wrapper").show();
    $(".card-title").html("Listado de contratos");
    $("#formSave").html("");
  };

  const getTypesContracts = (id) => {
    $.ajax({
      url: BASE_URL + "contract.php",
      type: "GET",
      headers: {
        accion: "listarTypesContracts",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#type_contract_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#type_contract_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };

  const getCountries = (id) => {
    $.ajax({
      url: BASE_URL + "contract.php",
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
      url: BASE_URL + "contract.php",
      type: "GET",
      headers: {
        accion: "listarCities",
        token: createToken(getToken()),
      },
      data: { country_id: country_id },
    }).done(function (response) {
      $("#city_id").html("");
      $("#city_id").append(
        '<option value="">Seleccione una ciudad...</option>'
      );
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

  const getHeadquarters = (city_id, id) => {
    $.ajax({
      url: BASE_URL + "contract.php",
      type: "GET",
      headers: {
        accion: "listarHeadquarters",
        token: createToken(getToken()),
      },
      data: { city_id: city_id },
    }).done(function (response) {
      $("#seat_id").html("");
      $("#seat_id").append('<option value="">Seleccione una sede...</option>');
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#seat_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#seat_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };

  const getEmployees = (seat_id, id) => {
    $.ajax({
      url: BASE_URL + "contract.php",
      type: "GET",
      headers: {
        accion: "listarEmployees",
        token: createToken(getToken()),
      },
      data: { seat_id: seat_id },
    }).done(function (response) {
      $("#employe_id").html("");
      $("#employe_id").append(
        '<option value="">Seleccione un empleado...</option>'
      );
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#employe_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              " " +
              value.last_name +
              " - " +
              value.no_document +
              "</option>"
          );
        else
          $("#employe_id").append(
            "<option value='" +
              value.id +
              "'>" +
              value.name +
              " " +
              value.last_name +
              " - " +
              value.no_document +
              "</option>"
          );
      });
    });
  };

  const getProfessions = (id) => {
    $.ajax({
      url: BASE_URL + "contract.php",
      type: "GET",
      headers: {
        accion: "listarProfessions",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#profession_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#profession_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };
}
