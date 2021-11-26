function my_invoicesCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_invoice.php",
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
            ? '<button class="btn btn-danger btn-xs mr-1 anular" title="Anular factura"><i class="fas fa-ban"></i></button>' +
                '<button class="btn btn-dark btn-xs generate" title="Generar factura"><i class="far fa-eye"></i></button>'
            : "";
        },
      },
      { data: "client" },
      { data: "employe" },
      {
        data: "iva",
        render: function (data) {
          return "$ " + new Intl.NumberFormat("de-DE").format(data);
        },
      },
      {
        data: "total",
        render: function (data) {
          return "$ " + new Intl.NumberFormat("de-DE").format(data);
        },
      },
      {
        data: "neto",
        render: function (data) {
          return "$ " + new Intl.NumberFormat("de-DE").format(data);
        },
      },
      {
        data: "status",
        render: function (data) {
          return data == 1 ? "Activo" : "Anulada";
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

  $("#listado").on("click", ".anular", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_invoice.php",
      type: "DELETE",
      headers: {
        accion: "anular",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Factura anulada con éxito");
      else toastr.error("Error al anular la factura");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".generate", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_invoice.php",
      type: "GET",
      headers: {
        accion: "printInvoice",
        token: createToken(getToken()),
      },
      data: { invoice_id: data.id },
    }).done(function (response) {
      debugBase64("data:application/pdf;base64," + JSON.parse(response).pdf);
    });
  });

  function debugBase64(base64URL) {
    window
      .open()
      .document.write(
        '<iframe src="' +
          base64URL +
          '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>'
      );
  }
}
