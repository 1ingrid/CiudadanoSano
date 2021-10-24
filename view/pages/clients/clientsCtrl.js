function clientsCtrl() {
  var confir_docu = false;

  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "client.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar cliente"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar cliente"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar cliente"><i class="far fa-edit"></i></button>'
          );
        },
      },
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
    $(".card-title").html("Crear cliente");
    $("#formSave").load("./clients/nuevo.php", function () {
      $("#alert").hide();
      $("#alertDocu").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
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
          url: BASE_URL + "client.php",
          type: "POST",
          headers: {
            accion: "registro",
            token: createToken(getToken()),
          },
          data: form.serialize(),
        }).done(function (response) {
          if (response == 200) toastr.success("Cliente agregado con exito");
          else toastr.error("Error al agregar el cliente");
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
    $(".card-title").html("Actualizar cliente");
    $("#formSave").load("./clients/editar.php", function () {
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
          url: BASE_URL + "client.php",
          type: "PUT",
          headers: {
            accion: "modificar",
            token: createToken(getToken()),
          },
          data: JSON.stringify(getFormData(form)),
          contentType: "application/json",
        }).done(function (response) {
          if (response == 1) toastr.success("Cliente actualizado con exito");
          else toastr.error("Error al actualizar el cliente");
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
      url: BASE_URL + "client.php",
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
      url: BASE_URL + "client.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Cliente desactivado con exito");
      else toastr.error("Error al desactivar el cliente");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "client.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Cliente activado con exito");
      else toastr.error("Error al activar el cliente");
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
    $(".card-title").html("Listado de clientes");
    $("#formSave").html("");
  };
}
