function types_contractsCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "type_contract.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar tipo de contrato"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar tipo de contrato"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar tipo de contrato"><i class="far fa-edit"></i></button>'
          );
        },
      },
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
    $(".card-title").html("Crear tipo de contrato");
    $("#formSave").load("./types_contracts/nuevo.php", function () {
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (!form[0].name.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "type_contract.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1)
          toastr.success("Tipo de contrato agregado con éxito");
        else toastr.error("Error al agregar el tipo de contrato");
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
    $(".card-title").html("Actualizar tipo de contrato");
    $("#formSave").load("./types_contracts/editar.php", function () {
      $("#alert").hide();
      $("#id").val(data.id);
      $("#name").val(data.name);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (!form[0].name.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "type_contract.php",
        type: "PUT",
        headers: {
          accion: "modificar",
          token: createToken(getToken()),
        },
        data: JSON.stringify(getFormData(form)),
        contentType: "application/json",
      }).done(function (response) {
        if (response == 1)
          toastr.success("Tipo de contrato actualizado con éxito");
        else toastr.error("Error al actualizar el tipo de contrato");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "type_contract.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1)
        toastr.success("Tipo de contrato desactivado con éxito");
      else toastr.error("Error al desactivar el tipo de contrato");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "type_contract.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Tipo de contrato activado con éxito");
      else toastr.error("Error al activar el tipo de contrato");
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
    $(".card-title").html("Listado de tipos de contratos");
    $("#formSave").html("");
  };
}
