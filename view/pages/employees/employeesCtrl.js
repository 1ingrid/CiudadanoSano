function employeesCtrl() {
  var confir_docu = false;

  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "employe.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar empleado"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar empleado"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar empleado"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "country" },
      { data: "city" },
      { data: "seat" },
      { data: "no_document" },
      { data: "name" },
      { data: "last_name" },
      { data: "email" },
      { data: "address" },
      { data: "cell_phone" },
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
    $(".card-title").html("Crear empleado");
    $("#formSave").load("./employees/nuevo.php", function () {
      getCountries();
      confir_docu = false;
      $("#alert").hide();
      $("#alertDocu").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].country_id.value ||
      !form[0].city_id.value ||
      !form[0].seat_id.value ||
      !form[0].no_document.value ||
      !form[0].name.value ||
      !form[0].last_name.value ||
      !form[0].address.value ||
      !form[0].cell_phone.value ||
      !form[0].email.value
    ) {
      $("#alert").show();
    } else {
      $("#alert").hide();
      if (confir_docu) {
        $("#alertDocu").show();
      } else {
        $.ajax({
          url: BASE_URL + "employe.php",
          type: "POST",
          headers: {
            accion: "registro",
            token: createToken(getToken()),
          },
          data: form.serialize(),
        }).done(function (response) {
          if (response == 1) toastr.success("Empleado agregado con exito");
          else toastr.error("Error al agregar el empleado");
          volver();
          dt.page("last").draw("page");
          dt.ajax.reload(null, false);
        });
      }
    }
  });

  $("#listado").on("click", ".editar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $(".nuevo").hide();
    $("#listado_wrapper").hide();
    $(".card-title").html("Actualizar empleado");
    $("#formSave").load("./employees/editar.php", function () {
      getCountries(data.country_id);
      getCities(data.country_id, data.city_id);
      getHeadquarters(data.city_id, data.seat_id);
      confir_docu = false;
      $("#alert").hide();
      $("#alertDocu").hide();
      $("#id").val(data.id);
      $("#no_document").val(data.no_document);
      $("#name").val(data.name);
      $("#last_name").val(data.last_name);
      $("#address").val(data.address);
      $("#cell_phone").val(data.cell_phone);
      $("#email").val(data.email);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (
      !form[0].country_id.value ||
      !form[0].city_id.value ||
      !form[0].seat_id.value ||
      !form[0].no_document.value ||
      !form[0].name.value ||
      !form[0].last_name.value ||
      !form[0].address.value ||
      !form[0].cell_phone.value ||
      !form[0].email.value
    ) {
      $("#alert").show();
    } else {
      $("#alert").hide();
      if (confir_docu) {
        $("#alertDocu").show();
      } else {
        $.ajax({
          url: BASE_URL + "employe.php",
          type: "PUT",
          headers: {
            accion: "modificar",
            token: createToken(getToken()),
          },
          data: JSON.stringify(getFormData(form)),
          contentType: "application/json",
        }).done(function (response) {
          if (response == 1) toastr.success("Empleado actualizado con exito");
          else toastr.error("Error al actualizar el empleado");
          volver();
          dt.page("last").draw("page");
          dt.ajax.reload(null, false);
        });
      }
    }
  });

  $(".card").on("keyup", "#no_document", function (e) {
    e.preventDefault();
    $.ajax({
      url: BASE_URL + "employe.php",
      type: "GET",
      headers: {
        accion: "verificarDocument",
        token: createToken(getToken()),
      },
      data: { no_document: $(this).val() },
    }).done(function (response) {
      confir_docu = JSON.parse(response).exists;
    });
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "employe.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Empleado desactivado con exito");
      else toastr.error("Error al desactivar el empleado");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "employe.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Empleado activado con exito");
      else toastr.error("Error al activar el empleado");
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

  $(".card").on("click", "#close", function () {
    volver();
  });

  const volver = () => {
    $(".nuevo").show();
    $("#listado_wrapper").show();
    $(".card-title").html("Listado de empleados");
    $("#formSave").html("");
  };

  const getCountries = (id) => {
    $.ajax({
      url: BASE_URL + "employe.php",
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
      url: BASE_URL + "employe.php",
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
      url: BASE_URL + "employe.php",
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
}
