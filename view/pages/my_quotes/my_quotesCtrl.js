function my_quotesCtrl() {
  var hours = [
    { value: "08:00", option: "08:00 a.m." },
    { value: "08:20", option: "08:20 a.m." },
    { value: "08:40", option: "08:40 a.m." },
    { value: "09:00", option: "09:00 a.m." },
    { value: "09:20", option: "09:20 a.m." },
    { value: "09:40", option: "09:40 a.m." },
    { value: "10:00", option: "10:00 a.m." },
    { value: "10:20", option: "10:20 a.m." },
    { value: "10:40", option: "10:40 a.m." },
    { value: "11:00", option: "11:00 a.m." },
    { value: "11:20", option: "11:20 a.m." },
    { value: "11:40", option: "11:40 a.m." },
    { value: "14:00", option: "02:00 p.m." },
    { value: "14:20", option: "02:20 p.m." },
    { value: "14:40", option: "02:40 p.m." },
    { value: "15:00", option: "03:00 p.m." },
    { value: "15:20", option: "03:20 p.m." },
    { value: "15:40", option: "03:40 p.m." },
    { value: "16:00", option: "04:00 p.m." },
    { value: "16:20", option: "04:20 p.m." },
    { value: "16:40", option: "04:40 p.m." },
    { value: "17:00", option: "05:00 p.m." },
    { value: "17:20", option: "05:20 p.m." },
    { value: "17:40", option: "05:40 p.m." },
  ];

  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_quote.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 cancelQuote" title="Cancelar cita medica"><i class="fas fa-ban"></i></button>'
              : '')
          );
        },
      },
      { data: "employe" },
      { data: "profession",
        render: function (data) {
          if(data === 'Medico') return 'Consulta General';
        }
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
          return data == 1 ? "Activa" : "Cancelada";
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
    $(".card-title").html("Asignar cita medica");
    $("#formSave").load("./my_quotes/nuevo.php", function () {
      getHeadquarters();
      $("#alert").hide();
      $("#alertDis").hide();
      $("#alertNone").hide();
      $("#date").datepicker({ minDate: 1, maxDate: "+7D" });
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].seat_id.value ||
      !form[0].type_quote.value ||
      !form[0].employe_id.value ||
      !form[0].date.value ||
      !form[0].hour.value
    ) {
      $("#alert").show();
    } else {
      $.ajax({
        url: BASE_URL + "my_quote.php",
        type: "POST",
        headers: {
          accion: "registro",
          token: createToken(getToken()),
        },
        data: form.serialize(),
      }).done(function (response) {
        if (response == 1) toastr.success("Cita agendada con exito");
        else toastr.error("Error al agendar la cita");
        volver();
        dt.page("last").draw("page");
        dt.ajax.reload(null, false);
      });
    }
  });

  $("#listado").on("click", ".cancelQuote", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "my_quote.php",
      type: "DELETE",
      headers: {
        accion: "cancel",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Cita cancelada con exito");
      else toastr.error("Error al cancelar la cita");
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
    $(".card-title").html("Listado de citas medicas");
    $("#formSave").html("");
  };

  $(".card").on("change", "#type_quote", function (e) {
    e.preventDefault();
    getEmployees($(this).val());
  });

  $(".card").on("change", "#date", function (e) {
    e.preventDefault();
    $("#hour").html("");
    $.each(hours, function (index, item) {
      $("#hour").append(
        "<option value='" + item.value + "'>" + item.option + "</option>"
      );
    });
  });

  $(".card").on("change", "#hour", function (e) {
    e.preventDefault();
    getHours($("#date").val(), $(this).val(), $("#employe_id").val());
  });

  const getEmployees = (type_quote, id) => {
    $.ajax({
      url: BASE_URL + "my_quote.php",
      type: "GET",
      headers: {
        accion: "listarEmployees",
        token: createToken(getToken()),
      },
      data: { type_quote: type_quote },
    }).done(function (response) {
      $("#employe_id").html("");
      $("#employe_id").append(
        '<option value="">Seleccione un medico...</option>'
      );
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#employe_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              " " +
              value.last_name +
              "</option>"
          );
        else
          $("#employe_id").append(
            "<option value='" +
              value.id +
              "'>" +
              value.name +
              " " +
              value.last_name +
              "</option>"
          );
      });
    });
  };

  const getHeadquarters = (id) => {
    $.ajax({
      url: BASE_URL + "my_quote.php",
      type: "GET",
      headers: {
        accion: "listarHeadquarters",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#seat_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#seat_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };

  const getHours = (date, hour, doctor) => {
    $.ajax({
      url: BASE_URL + "my_quote.php",
      type: "GET",
      headers: {
        accion: "verifyAvailability",
        token: createToken(getToken()),
      },
      data: { date: date, hour: hour, doctor: doctor },
    }).done(function (response) {
      if (JSON.parse(response)["data"].available == 1) {
        $("#hour").html("");
        $("#alertDis").show();
        $("#alertNone").hide();
        $.each(JSON.parse(response)["data"]["hours"], function (index, item) {
          $("#hour").append(
            "<option value='" + item.value + "'>" + item.index + "</option>"
          );
        });
      } else if (JSON.parse(response)["data"].available == 2) {
        $("#alertDis").hide();
        $("#alertNone").show();
        $("#hour").append(
          "<option value=''>No existen citas, mejor seleccione otro día</option>"
        );
      } else {
        $("#alertDis").hide();
        $("#alertNone").hide();
      }
    });
  };
}
