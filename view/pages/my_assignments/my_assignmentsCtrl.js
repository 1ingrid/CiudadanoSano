function my_assignmentsCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_assignment.php",
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
          return data == 0
            ? '<select class="form-control status bg-dark">' +
                '<option value="">Seleccione...</option>' +
                '<option value="1">Atendida</option>' +
                '<option value="3">Incumplida</option>' +
                "</select>"
            : "";
        },
      },
      { data: "client" },
      {
        data: "profession",
        render: function (data) {
          if (data === "Medico") return "Consulta General";
          if (data === "Odontologo") return "Consulta Odontologica";
          if (data === "Optometra") return "Consulta Optometria";
        },
      },
      {
        data: "date",
        render: function (data) {
          return moment(data).format("DD MMM yyyy hh:mm A");
        },
      },
      {
        data: "status",
        render: function (data) {
          if(data == 0) return "Pendiente";
          if(data == 1) return "Atendida";
          if(data == 2) return "Cancelada";
          if(data == 3) return "Incumplida";
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

  $("#listado").on("change", ".status", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_assignment.php",
      type: "DELETE",
      headers: {
        accion: "changeStatus",
        token: createToken(getToken()),
      },
      data: JSON.stringify({ id: data.id, status: $(this).val() }),
      contentType: "application/json",
    }).done(function (response) {
      if (response == 1) toastr.success("Cita cambiada de estado con exito");
      else toastr.error("Error al cambiar el estado de la cita");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });
}
