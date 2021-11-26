function productsCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "product.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar producto"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar producto"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar producto"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "name" },
      { data: "provider" },
      { data: "presentation" },
      {
        data: "price",
        render: function (data) {
          return "$ " + new Intl.NumberFormat("de-DE").format(data);
        },
      },
      {
        data: "cost",
        render: function (data) {
          return "$ " + new Intl.NumberFormat("de-DE").format(data);
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
    $(".card-title").html("Crear producto");
    $("#formSave").load("./products/nuevo.php", function () {
      getProvider();
      $("#alert").hide();
      $("#alertImgSize").hide();
      $("#alertImgType").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = new FormData($("form")[0]);
    if (
      !form.get("provider_id") ||
      !form.get("name") ||
      !form.get("presentation") ||
      form.get("img")["size"] <= 0 ||
      !form.get("price") ||
      !form.get("cost")
    ) {
      $("#alert").show();
    } else {
      console.log(form.get("img"));
      if (form.get("img")["size"] > 2000000) {
        $("#alertImgSize").show();
      } else if (
        form.get("img")["type"] !== "image/png" &&
        form.get("img")["type"] !== "image/jpg" &&
        form.get("img")["type"] !== "image/jpeg"
      ) {
        $("#alertImgType").show();
      } else {
        $.ajax({
          url: BASE_URL + "product.php",
          type: "POST",
          headers: {
            accion: "registro",
            token: createToken(getToken()),
          },
          data: form,
          contentType: false,
          processData: false,
        }).done(function (response) {
          if (response == 1) toastr.success("Producto agregado con éxito");
          else toastr.error("Error al agregar el producto");
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
    $(".card-title").html("Actualizar producto");
    $("#formSave").load("./products/editar.php", function () {
      getProvider(data.provider_id);
      $("#alert").hide();
      $("#alertImgSize").hide();
      $("#alertImgType").hide();
      $("#id").val(data.id);
      $("#name").val(data.name);
      $("#presentation").val(data.presentation);
      $("#price").val(data.price);
      $("#cost").val(data.cost);
      $("#imgCurrent").html("");
      $("#imgCurrent").html(
        '<img src="../../uploads/products/' + data.img + '" width="200" />'
      );
    });
  });

  $(".card").on("click", "#update", function () {
    var form = new FormData($("form")[0]);
    if (
      !form.get("provider_id") ||
      !form.get("name") ||
      !form.get("presentation") ||
      !form.get("price") ||
      !form.get("cost")
    ) {
      $("#alert").show();
    } else {
      var verify = false;
      if (form.get("img")["size"] > 0) {
        if (form.get("img")["size"] > 2000000) {
          verify = true;
          $("#alertImgSize").show();
        } else if (
          form.get("img")["type"] !== "image/png" &&
          form.get("img")["type"] !== "image/jpg" &&
          form.get("img")["type"] !== "image/jpeg"
        ) {
          verify = true;
          $("#alertImgType").show();
        }
      }
      if (!verify) {
        $.ajax({
          url: BASE_URL + "product.php",
          type: "POST",
          headers: {
            accion: "modificar",
            token: createToken(getToken()),
          },
          data: form,
          contentType: false,
          processData: false,
        }).done(function (response) {
          if (response == 1) toastr.success("Producto actualizado con éxito");
          else toastr.error("Error al actualizar el producto");
          volver();
          dt.page("last").draw("page");
          dt.ajax.reload(null, false);
        });
      }
    }
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "product.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Producto desactivado con éxito");
      else toastr.error("Error al desactivar el producto");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "product.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Producto activado con éxito");
      else toastr.error("Error al activar el producto");
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
    $(".card-title").html("Listado de productos");
    $("#formSave").html("");
  };

  const getProvider = (id) => {
    $.ajax({
      url: BASE_URL + "product.php",
      type: "GET",
      headers: {
        accion: "listarProviders",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#provider_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#provider_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };
}
