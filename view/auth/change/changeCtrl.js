function changeCtrl() {
  $("#alert").hide();
  $("#alertPass").hide();

  $("form").on("click", "#change", function () {
    const token = extractToken();
    if (!token) {
      toastr.error("Key no incluida");
    } else {
      var form = $("form");
      if (!form[0].password.value || !form[0].confir_password.value) {
        $("#alert").show();
      } else {
        $("#alert").hide();
        if (form[0].password.value !== form[0].confir_password.value) {
          $("#alertPass").show();
        } else {
          $.ajax({
            url: "../../../controller/auth.php",
            type: "PUT",
            headers: {
              accion: "change",
            },
            data: JSON.stringify({ key: token, password: form[0].password.value }),
            contentType: "application/json",
          }).done(function (response) {
            if (response == 1) {
              toastr.success("Password cambiado con exito");
              setTimeout(function () {
                location.href = "../login";
              }, 3000);
            } else {
              toastr.error("Ha ocurrido un error o el key expiro");
            }
          });
        }
      }
    }
  });

  const extractToken = () => {
    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    return urlParams.get("key");
  };
}
