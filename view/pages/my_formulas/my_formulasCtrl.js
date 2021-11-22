function my_formulasCtrl() {
    var dt = $("#listado").DataTable({
      ajax: {
        url: BASE_URL + "my_formula.php",
        type: "GET",
        headers: {
          accion: "listar",
          token: createToken(getToken()),
        },
      },
      columns: [
        {
          data: "formula_status",
          render: function (data) {
            return data == 1
                ? '<button class="btn btn-info btn-xs mr-1 alta" title="Dar de alta"><i class="fas fa-arrow-up"></i></button>'
                : ''
          },
        },
        { data: "id" },
        { data: "client" },
        {
          data: "formula_status",
          render: function (data) {
            return data == 1 ? "Pendiente" : "Entregada";
          },
        },
        {
            data: "formula_date",
            render: function (data) {
              return moment(data).format("DD-MM-yyyy");
            },
          },
        {
          data: "created_at",
          render: function (data) {
            return moment(data).format("DD-MM-yyyy");
          },
        },
      ],
    });
  
    $("#listado").on("click", ".alta", function () {
      var data = dt.row($(this).parents("tr")).data();
      $.ajax({
        url: BASE_URL + "my_formula.php",
        type: "DELETE",
        headers: {
          accion: "alta",
          token: createToken(getToken()),
        },
        data: { id: data.id },
      }).done(function (response) {
        if (response == 1) toastr.success("Formula dada de alta con exito");
        else toastr.error("Error al dar de alta a la formula");
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    });
    
  }
  