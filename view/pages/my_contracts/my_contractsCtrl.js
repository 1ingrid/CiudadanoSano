function my_contractsCtrl() {
  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "my_contract.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar contrato"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar contrato"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar contrato"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "id" },
      { data: "type_contract" },
      { data: "no_document" },
      { data: "employe" },
      { data: "profession" },
      {
        data: "date_init",
        render: function (data) {
          return moment(data).format("DD-MM-yyyy");
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
    $(".card-title").html("Crear contrato");
    $("#formSave").load("./my_contracts/nuevo.php", function () {
      getTypesContracts();
      getEmployees();
      getProfessions();
      $("#alert").hide();
    });
  });

  $(".card").on("click", "#close", function () {
    volver();
  });

  const volver = () => {
    $(".nuevo").show();
    $("#listado_wrapper").show();
    $(".card-title").html("Listado de contratos");
    $("#formSave").html("");
  };

  const getTypesContracts = (id) => {
    $.ajax({
      url: BASE_URL + "my_contract.php",
      type: "GET",
      headers: {
        accion: "listarTypesContracts",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#type_contract_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#type_contract_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };

  const getEmployees = (id) => {
    $.ajax({
      url: BASE_URL + "my_contract.php",
      type: "GET",
      headers: {
        accion: "listarEmployees",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $("#employe_id").html("");
      $("#employe_id").append(
        '<option value="">Seleccione un empleado...</option>'
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
              " - " +
              value.no_document +
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
              " - " +
              value.no_document +
              "</option>"
          );
      });
    });
  };

  const getProfessions = (id) => {
    $.ajax({
      url: BASE_URL + "my_contract.php",
      type: "GET",
      headers: {
        accion: "listarProfessions",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#profession_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#profession_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };
}
