function billingCtrl() {
  var product = {},
    products = [];

  $("#no_document").keyup(function (e) {
    e.preventDefault();
    getClient(e.target.value);
  });

  $("#product_id").keyup(function (e) {
    e.preventDefault();
    getProduct(e.target.value);
  });

  $("#count_product").keyup(function (e) {
    e.preventDefault();
    product.count = parseInt($(this).val());
    product.total = product.count * product.price;
    $("#price_sale_total").html(
      new Intl.NumberFormat("de-DE").format(product.total)
    );
    if (
      product.count < 1 ||
      product.count > parseInt(product.stock) ||
      !product.count
    ) {
      $("#add_product_sale").slideUp();
      $("#price_sale").html("0.00");
      $("#price_sale_total").html("0.00");
    } else {
      $("#price_sale").html(
        new Intl.NumberFormat("de-DE").format(product.price)
      );
      $("#add_product_sale").slideDown();
    }
  });

  $("#add_product_sale").click(function () {
    products.push(product);
    loadDetail();
  });

  $("#tablaD").on("click", ".borrar", function () {
    products.splice($(this).data("codigo"), 1);
    loadDetail();
  });

  $("#cancel").click(function () {
    resetProduct();
    products = [];
    product = {};
    $("#id").val("");
    $("#product_id").val("");
    $("#no_document").val("");
    $("#name").val("");
    $("#last_name").val("");
    $("#tablaD").html("");
    $("#subTotal").html("$ 0");
    $("#iva").html("$ 0");
    $("#total").html("$ 0");
    $("#procesar").attr("disabled", true);
  });

  $("#process").click(function () {
    if ($("#id").val() !== "") {
      $.ajax({
        url: BASE_URL + "billing.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: {
          client_id: $("#id").val(),
          iva: product.iva,
          total: product.subtotal,
          neto: product.total,
          mov: products,
        },
      }).done(function (response) {
        if (JSON.parse(response).code == 200)
          debugBase64(
            "data:application/pdf;base64," + JSON.parse(response).pdf
          );
      });
    }
  });

  const loadDetail = () => {
    product.subtotal = 0;
    $("#tablaD").empty();
    $.each(products, function (index, value) {
      $("#tablaD").append(
        `<tr>
          <td>${value.id}</td>
          <td>${value.name}</td>
          <td>${value.count}</td>
          <td>${new Intl.NumberFormat("de-DE").format(value.price)}</td>
          <td>${new Intl.NumberFormat("de-DE").format(value.total)}</td>
          <td><button data-codigo="${index}" class="btn btn-danger btn-sm borrar"><i class="fas fa-trash"></i></button></td>
        </tr>`
      );
      product.subtotal += parseInt(value.total);
    });
    product.iva = product.subtotal * 0.19;
    $("#subTotal").html(
      "$ " + new Intl.NumberFormat("de-DE").format(product.subtotal)
    );
    $("#iva").html("$ " + new Intl.NumberFormat("de-DE").format(product.iva));
    $("#total").html(
      "$ " +
        new Intl.NumberFormat("de-DE").format(product.subtotal + product.iva)
    );
    $("html, body").animate({ scrollTop: $("#cont").height() }, 800);
    if (products.length === 0) $("#process").attr("disabled", true);
    else $("#process").attr("disabled", false);
  };

  function debugBase64(base64URL) {
    window
      .open()
      .document.write(
        '<iframe src="' +
          base64URL +
          '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>'
      );
  }

  const getClient = (id) => {
    $.ajax({
      url: BASE_URL + "billing.php",
      type: "GET",
      headers: {
        accion: "getClient",
        token: createToken(getToken()),
      },
      data: { no_document: id },
    }).done(function (response) {
      $("#id").val(JSON.parse(response).id);
      $("#name").val(JSON.parse(response).name);
      $("#last_name").val(JSON.parse(response).last_name);
    });
  };

  const getProduct = (id) => {
    $.ajax({
      url: BASE_URL + "billing.php",
      type: "GET",
      headers: {
        accion: "getProduct",
        token: createToken(getToken()),
      },
      data: { product_id: id },
    }).done(function (response) {
      if (Object.entries(JSON.parse(response)).length !== 0) {
        $("#name_product").html(JSON.parse(response).name);
        $("#stock").html(JSON.parse(response).stock);
        $("#count_product").val(1);
        $("#price_sale").html(
          new Intl.NumberFormat("de-DE").format(JSON.parse(response).price)
        );
        $("#price_sale_total").html(
          new Intl.NumberFormat("de-DE").format(JSON.parse(response).price)
        );
        $("#count_product").removeAttr("disabled");
        $("#add_product_sale").slideDown();
        $("#add_product_sale").focus();
        product = JSON.parse(response);
        product.count = 1;
        product.total = product.price;
      } else {
        resetProduct();
      }
    });
  };

  const resetProduct = () => {
    $("#name_product").html("-");
    $("#stock").html("-");
    $("#count_product").val("0");
    $("#price_sale").html("0.00");
    $("#price_sale_total").html("0.00");
    $("#count_product").attr("disabled", true);
    $("#add_product_sale").slideUp();
  };
}
