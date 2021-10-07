function loginCtrl() {
  $("#alert").hide();

  $("form").on("click", "#signin", function () {
    var form = $("form");
    if (!form[0].email.value || !form[0].password.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: "../../../controller/auth.php",
        type: "POST",
        headers: {
          accion: "login",
        },
        data: form.serialize(),
      }).done(function (response) {
        if (JSON.parse(response).jwtToken) {
          localStorage.setItem("token", JSON.parse(response).jwtToken);
          var setting = {
            permits: JSON.parse(response).permits,
            redirectTo: JSON.parse(response).permits.split(",")[1],
            name: JSON.parse(response).name,
          };
          localStorage.setItem("setting", JSON.stringify(setting));
          location.href = "../../pages/pages.php";
        } else {
          toastr.info("Datos incorrectos o usuario inactivo");
        }
      });
    }
  });
}
