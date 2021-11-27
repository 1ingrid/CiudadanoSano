function usersCtrl() {
  var confir_email = false;

  var dt = $("#listado").DataTable({
    ajax: {
      url: BASE_URL + "user.php",
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
              ? '<button class="btn btn-danger btn-xs mr-1 desactivar" title="Desactivar usuario"><i class="fas fa-trash"></i></button>'
              : '<button class="btn btn-info btn-xs mr-1 activar" title="Activar usuario"><i class="fas fa-redo-alt"></i></button>') +
            '<button class="btn btn-success btn-xs editar" title="Editar usuario"><i class="far fa-edit"></i></button>'
          );
        },
      },
      { data: "rol" },
      { data: "name" },
      { data: "last_name" },
      { data: "email" },
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
    $(".card-title").html("Crear usuario");
    $("#formSave").load("./users/nuevo.php", function () {
      getRoles();
      confir_email = false;
      $("#alert").hide();
      $("#alertPass").hide();
      $("#alertEmail").hide();
    });
  });

  $(".card").on("click", "#create", function () {
    var form = $("form");
    if (
      !form[0].name.value ||
      !form[0].last_name.value ||
      !form[0].rol_id.value ||
      !form[0].email.value ||
      !form[0].password.value ||
      !form[0].confir_password.value
    ) {
      $("#alert").show();
    } else {
      $("#alert").hide();
      if (form[0].password.value !== form[0].confir_password.value) {
        $("#alertPass").show();
      } else {
        $("#alertPass").hide();
        if (confir_email) {
          $("#alertEmail").show();
        } else {
          $.ajax({
            url: BASE_URL + "user.php",
            type: "POST",
            headers: {
              accion: "registro",
              token: createToken(getToken()),
            },
            data: form.serialize(),
          }).done(function (response) {
            if (response == 1) toastr.success("Usuario agregado con éxito");
            else toastr.error("Error al agregar el usuario");
            volver();
            dt.page("last").draw("page");
            dt.ajax.reload(null, false);
          });
        }
      }
    }
  });

  $("#listado").on("click", ".editar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $(".nuevo").hide();
    $("#listado_wrapper").hide();
    $(".card-title").html("Actualizar usuario");
    $("#formSave").load("./users/editar.php", function () {
      getRoles(data.rol_id);
      confir_email = false;
      $("#alert").hide();
      $("#alertPass").hide();
      $("#alertEmail").hide();
      $("#id").val(data.id);
      $("#name").val(data.name);
      $("#last_name").val(data.last_name);
      $("#email").val(data.email);
    });
  });

  $(".card").on("click", "#update", function () {
    var form = $("form");
    if (
      !form[0].name.value ||
      !form[0].last_name.value ||
      !form[0].email.value
    ) {
      $("#alert").show();
    } else {
      $("#alert").hide();
      if (form[0].password.value !== form[0].confir_password.value) {
        $("#alertPass").show();
      } else {
        $("#alertPass").hide();
        if (confir_email) {
          $("#alertEmail").show();
        } else {
          $.ajax({
            url: BASE_URL + "user.php",
            type: "PUT",
            headers: {
              accion: "modificar",
              token: createToken(getToken()),
            },
            data: JSON.stringify(getFormData(form)),
            contentType: "application/json",
          }).done(function (response) {
            if (response == 1) toastr.success("Usuario actualizado con éxito");
            else toastr.error("Error al actualizar el usuario");
            volver();
            dt.page("last").draw("page");
            dt.ajax.reload(null, false);
          });
        }
      }
    }
  });

  $(".card").on("keyup", "#email", function (e) {
    e.preventDefault();
    $.ajax({
      url: BASE_URL + "user.php",
      type: "GET",
      headers: {
        accion: "verificarEmail",
        token: createToken(getToken()),
      },
      data: { email: $(this).val() },
    }).done(function (response) {
      confir_email = JSON.parse(response).exists;
    });
  });

  $("#listado").on("click", ".desactivar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "user.php",
      type: "DELETE",
      headers: {
        accion: "desactivar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Usuario desactivado con éxito");
      else toastr.error("Error al desactivar el usuario");
      dt.page("last").draw("page");
      dt.ajax.reload(null, false);
    });
  });

  $("#listado").on("click", ".activar", function () {
    var data = dt.row($(this).parents("tr")).data();
    $.ajax({
      url: BASE_URL + "user.php",
      type: "DELETE",
      headers: {
        accion: "activar",
        token: createToken(getToken()),
      },
      data: { id: data.id },
    }).done(function (response) {
      if (response == 1) toastr.success("Usuario activado con éxito");
      else toastr.error("Error al activar el usuario");
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
    $(".card-title").html("Listado de usuarios");
    $("#formSave").html("");
  };

  const getRoles = (id) => {
    $.ajax({
      url: BASE_URL + "user.php",
      type: "GET",
      headers: {
        accion: "listarRoles",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $.each(JSON.parse(response)["data"], function (index, value) {
        if (id && id == value.id)
          $("#rol_id").append(
            "<option selected value='" +
              value.id +
              "'>" +
              value.name +
              "</option>"
          );
        else
          $("#rol_id").append(
            "<option value='" + value.id + "'>" + value.name + "</option>"
          );
      });
    });
  };
}
