function rolesCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "role.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar rol"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar rol"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar rol"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "name" },
      { data: "description" },
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
    $(".card-title").html("Crear rol");
    $("#formSave").load("./roles/nuevo.php", function () {
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (!form[0].name.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "role.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Rol agregado con éxito");
        else toastr.error("Error al agregar el rol");
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
    $(".card-title").html("Actualizar rol");
    $("#formSave").load("./roles/editar.php", function () {
      $("#alert").hide();
      $("#id").val(data.id);
      $("#name").val(data.name);
      $("#description").val(data.description);
      var permits = data.permits.split(",");
      permits.splice(0, 1);
      if (permits.indexOf("roles") > -1) $("#roles").prop("checked", true);
      if (permits.indexOf("users") > -1) $("#users").prop("checked", true);
      if (permits.indexOf("countries") > -1) $("#countries").prop("checked", true);
      if (permits.indexOf("cities") > -1) $("#cities").prop("checked", true);
      if (permits.indexOf("headquarters") > -1) $("#headquarters").prop("checked", true);
      if (permits.indexOf("types_contracts") > -1) $("#types_contracts").prop("checked", true);
      if (permits.indexOf("contracts") > -1) $("#contracts").prop("checked", true);
      if (permits.indexOf("clients") > -1) $("#clients").prop("checked", true);
      if (permits.indexOf("professions") > -1) $("#professions").prop("checked", true);
      if (permits.indexOf("employees") > -1) $("#employees").prop("checked", true);
      if (permits.indexOf("providers") > -1) $("#providers").prop("checked", true);
      if (permits.indexOf("mepas") > -1) $("#mepas").prop("checked", true);
      if (permits.indexOf("products") > -1) $("#products").prop("checked", true);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (!form[0].name.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "role.php",
        type: "PUT",
        headers: {
          accion: "modificar",
          token: createToken(getToken()),
        },
        data: JSON.stringify(getFormData(form)),
        contentType: "application/json",
      }).done(function (response) {
        if (response == 1) toastr.success("Rol actualizado con éxito");
        else toastr.error("Error al actualizar el rol");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "role.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Rol desactivado con éxito");
      else toastr.error("Error al desactivar el rol");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "role.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Rol activado con éxito");
      else toastr.error("Error al activar el rol");
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
    $(".card-title").html("Listado de roles");
    $("#formSave").html("");
  };
}
