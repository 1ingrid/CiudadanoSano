function my_payrollCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_payroll.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar nomina"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar nomina"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar nomina"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "name" },
      { data: "last_name" },
      { data: "bank_account" },
      { data: "no_account" },
      {
        data: "date",
        render: function (data) {
          return moment(data).format("DD-MM-yyyy hh:mm A");
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
    $(".card-title").html("Crear nomina");
    $("#formSave").load("./my_payroll/nuevo.php", function () {
      getEmployees();
      $("#alert").hide();
      $("#date").datetimepicker({ step: 10 });
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].employe_id.value ||
      !form[0].bank_account.value ||
      !form[0].no_account.value ||
      !form[0].date.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "my_payroll.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Nomina agregada con éxito");
        else toastr.error("Error al agregar la nomina");
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
    $(".card-title").html("Actualizar nomina");
    $("#formSave").load("./my_payroll/editar.php", function () {
      getEmployees(data.employe_id);
      $("#alert").hide();
      $("#id").val(data.id);
      $("#bank_account").val(data.bank_account);
      $("#no_account").val(data.no_account);
      $("#date").datetimepicker({ value: data.date, step: 10 });
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (
      !form[0].employe_id.value ||
      !form[0].bank_account.value ||
      !form[0].no_account.value ||
      !form[0].date.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "my_payroll.php",
        type: "PUT",
        headers: {
          accion: "modificar",
          token: createToken(getToken()),
        },
        data: JSON.stringify(getFormData(form)),
        contentType: "application/json",
      }).done(function (response) {
        if (response == 1) toastr.success("Nomina actualizada con éxito");
        else toastr.error("Error al actualizar la nomina");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_payroll.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Nomina desactivada con éxito");
      else toastr.error("Error al desactivar la nomina");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_payroll.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Nomina activada con éxito");
      else toastr.error("Error al activar la nomina");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $(".card").on("click", "#close", function () {
    volver();
  });

  const volver = () => {
    $(".nuevo").show();
    $("#listado_wrapper").show();
    $(".card-title").html("Listado de nominas");
    $("#formSave").html("");
  };

  const getEmployees = (id) => {
    $.ajax({
      url: BASE_URL + "my_payroll.php",
      type: "GET",
      headers: {
        accion: "listarEmployees",
        token: createToken(getToken()),
      },
    }).done(function (response) {
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
}
