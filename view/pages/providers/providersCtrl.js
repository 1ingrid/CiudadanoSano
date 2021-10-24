function providersCtrl() {
  var confir_nit = false;

  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "provider.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar proveedor"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar proveedor"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar proveedor"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "nit" },
      { data: "name" },
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
    $(".card-title").html("Crear proveedor");
    $("#formSave").load("./providers/nuevo.php", function () {
      $("#alert").hide();
      $("#alertNit").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].nit.value ||
      !form[0].name.value ||
      !form[0].address.value ||
      !form[0].cell_phone.value ||
      !form[0].email.value
    ) {
      $("#alert").show();
    } else {
      $("#alert").hide();
      if (confir_nit) {
        $("#alertNit").show();
      } else {
        $.ajax({
          url: BASE_URL + "provider.php",
          type: "POST",
          headers: {
            accion: "registro",
            token: createToken(getToken()),
          },
          data: form.serialize(),
        }).done(function (response) {
          if (response == 1) toastr.success("Proveedor agregado con exito");
          else toastr.error("Error al agregar el proveedor");
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
    $(".card-title").html("Actualizar proveedor");
    $("#formSave").load("./providers/editar.php", function () {
      $("#alert").hide();
      $("#alertNit").hide();
      $("#id").val(data.id);
      $("#nit").val(data.nit);
      $("#name").val(data.name);
      $("#address").val(data.address);
      $("#cell_phone").val(data.cell_phone);
      $("#email").val(data.email);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (
      !form[0].nit.value ||
      !form[0].name.value ||
      !form[0].address.value ||
      !form[0].cell_phone.value ||
      !form[0].email.value
    ) {
      $("#alert").show();
    } else {
      $("#alert").hide();
      if (confir_nit) {
        $("#alertNit").show();
      } else {
        $.ajax({
          url: BASE_URL + "provider.php",
          type: "PUT",
          headers: {
            accion: "modificar",
            token: createToken(getToken()),
          },
          data: JSON.stringify(getFormData(form)),
          contentType: "application/json",
        }).done(function (response) {
          if (response == 1) toastr.success("Proveedor actualizado con exito");
          else toastr.error("Error al actualizar el proveedor");
          volver();
          dt.page("last").draw("page");
          dt.ajax.reload(null, false);
        });
      }
    }
  });

  $(".card").on("keyup", "#nit", function (e) {
    e.preventDefault();
    $.ajax({
      url: BASE_URL + "provider.php",
      type: "GET",
      headers: {
        accion: "verificarNit",
        token: createToken(getToken()),
      },
      data: { nit: $(this).val() },
    }).done(function (response) {
      confir_nit = JSON.parse(response).exists;
    });
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "provider.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Proveedor desactivado con exito");
      else toastr.error("Error al desactivar el proveedor");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "provider.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Proveedor activado con exito");
      else toastr.error("Error al activar el proveedor");
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
    $(".card-title").html("Listado de proveedores");
    $("#formSave").html("");
  };
}
