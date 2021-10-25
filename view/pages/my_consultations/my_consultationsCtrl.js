function my_consultationsCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_consultation.php",
      type: "GET",
      headers: {
        accion: "listar",
        token: createToken(getToken()),
      },
    },
    columns: [
      {
        data: "status",
        render: function () {
          return '<button class="btn btn-success btn-xs editar" title="Editar consulta"><i class="far fa-edit"></i></button>';
        },
      },
      { data: "no_document" },
      { data: "client" },
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
    $(".card-title").html("Crear consulta");
    $("#formSave").load("./my_consultations/nuevo.php", function () {
      getClients();
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].client_id.value ||
      !form[0].reason.value ||
      !form[0].detail.value ||
      !form[0].formula.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "my_consultation.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Consulta agregada con exito");
        else toastr.error("Error al agregar la consulta");
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
    $(".card-title").html("Actualizar consulta");
    $("#formSave").load("./my_consultations/editar.php", function () {
      getClients(data.client_id);
      $("#alert").hide();
      $("#id").val(data.id);
      $("#reason").val(data.reason);
      $("#detail").val(data.detail);
      $("#formula").val(data.formula);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (
      !form[0].client_id.value ||
      !form[0].reason.value ||
      !form[0].detail.value ||
      !form[0].formula.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "my_consultation.php",
        type: "PUT",
        headers: {
          accion: "modificar",
          token: createToken(getToken()),
        },
        data: JSON.stringify(getFormData(form)),
        contentType: "application/json",
      }).done(function (response) {
        if (response == 1) toastr.success("Consulta actualizada con exito");
        else toastr.error("Error al actualizar la consulta");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $(".card").on("click", "#close", function () {
    volver();
  });

  const volver = () => {
    $(".nuevo").show();
    $("#listado_wrapper").show();
    $(".card-title").html("Listado de consultas");
    $("#formSave").html("");
  };

  const getClients = (id) => {
    $.ajax({
      url: BASE_URL + "my_consultation.php",
      type: "GET",
      headers: {
        accion: "listarClients",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#client_id").append(
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
          $("#client_id").append(
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
}
