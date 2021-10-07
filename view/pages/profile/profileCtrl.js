function profileCtrl() {
  var confir_email = false;

  $("#alert").hide();
  $("#alertPass").hide();
  $("#alertEmail").hide();

  const infoProfile = () => {
    $.ajax({
      url: BASE_URL + "profile.php",
      type: "GET",
      headers: {
        accion: "consultar",
        token: createToken(getToken()),
      },
    }).done(function (response) {
      $("#name").val(JSON.parse(response).name);
      $("#last_name").val(JSON.parse(response).last_name);
      $("#email").val(JSON.parse(response).email);
      $("#id").val(JSON.parse(response).id);
    });
  };

  $("form").on("keyup", "#email", function (e) {
    e.preventDefault();
    $.ajax({
      url: BASE_URL + "profile.php",
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

  $("form").on("click", "#update", function () {
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
            url: BASE_URL + "profile.php",
            type: "PUT",
            headers: {
              accion: "modificar",
              token: createToken(getToken()),
            },
            data: JSON.stringify(getFormData(form)),
            contentType: "application/json",
          }).done(function (response) {
            if (response == 1) toastr.success("Perfil actualizado con exito");
            else toastr.error("Error al actualizar el perfil");
            setTimeout(function () {
              var setting = JSON.parse(localStorage.getItem("setting"));
              setting.name = form[0].name.value;
              localStorage.setItem("setting", JSON.stringify(setting));
              location.href = "../pages/pages.php";
            }, 3000);
          });
        }
      }
    }
  });

  $("form").on("click", "#close", function () {
    location.href = "../pages/pages.php";
  });

  infoProfile();
}
