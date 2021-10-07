function recoverCtrl() {
  $("#alert").hide();

  $("form").on("click", "#recover", function () {
    var form = $("form");
    if (!form[0].email.value) {
      $("#alert").show();
    } else {
      $.ajax({
        url: "../../../controller/auth.php",
        type: "POST",
        headers: {
          accion: "recover",
        },
        data: form.serialize(),
      }).done(function (response) {
        if (JSON.parse(response).send) {
          toastr.success("Email enviado");
          setTimeout(function () {
            location.href = "../login";
          }, 3000);
        } else {
          toastr.error("Email no enviado");
        }
      });
    }
  });
}
