function billingCtrl() {
  var product = {};

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
    $("#price_sale_total").html(new Intl.NumberFormat("de-DE").format(product.total));
    if(product.count < 1 || product.count > parseInt(product.stock) || !product.count) {
        $("#add_product_sale").slideUp();
        $("#price_sale").html('0.00');
        $("#price_sale_total").html('0.00');
    } else {
        $("#price_sale").html(new Intl.NumberFormat("de-DE").format(product.price));
        $("#add_product_sale").slideDown();
    }
  });

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
