function my_inventoriesCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_inventory.php",
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
          return data == 1
            ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar inventario"><i class="fas fa-trash"></i></button>'
            : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar inventario"><i class="fas fa-redo-alt"></i></button>';
        },
      },
      { data: "product_id" },
      { data: "product" },
      { data: "entries" },
      { data: "stock" },
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
    $(".card-title").html("Crear inventario");
    $("#formSave").load("./my_inventories/nuevo.php", function () {
      getProducts();
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (!form[0].product_id.value || !form[0].entries.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "my_inventory.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Inventario agregado con éxito");
        else toastr.error("Error al agregar el inventario");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_inventory.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Inventario desactivado con éxito");
      else toastr.error("Error al desactivar el inventario");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_inventory.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Inventario activado con éxito");
      else toastr.error("Error al activar el inventario");
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
    $(".card-title").html("Listado de inventarios");
    $("#formSave").html("");
  };

  const getProducts = (id) => {
    $.ajax({
      url: BASE_URL + "my_inventory.php",
      type: "GET",
      headers: {
        accion: "listarProducts",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#product_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              " - " +
              value.presentation +
              " - " +
              value.provider +
              "</option>"
          );
        else
          $("#product_id").append(
            "<option value='" +
              value.id +
              "'>" +
              value.name +
              " - " +
              value.presentation +
              " - " +
              value.provider +
              "</option>"
          );
      });
    });
  };
}
