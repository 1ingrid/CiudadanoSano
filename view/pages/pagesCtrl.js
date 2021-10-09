function pagesCtrl() {
  var optionActive;

  const redirectTo = () => {
    if (!loggedIn()) location.href = "../auth/login";
    const url = "./" + getRedirectTo();
    $.post(url, { url: url }, function (data) {
      $(".content").html(data);
    });
  };

  const optionsMenu = () => {
    var modules = getPermits();
    $.each(modules, function (index, value) {
      if (index > 0) {
        $(".nav-sidebar").append(
          '<li class="nav-item"><a id="' +
            value +
            'S" href="./' +
            value +
            '" class="nav-link"><i class="fas fa-chevron-right nav-icon"></i><span><p>' +
            cFLetter(value) +
            "</p></span></a></li>"
        );
      } else {
        optionActive = value + "S";
        $(".nav-sidebar").append(
          '<li class="nav-item"><a id="' +
            value +
            'S" href="./' +
            value +
            '" class="nav-link active"><i class="fas fa-chevron-right nav-icon"></i><span><p>' +
            cFLetter(value) +
            "</p></span></a></li>"
        );
      }
    });

    $("#bdcbTitle").html(
      cFLetter(optionActive.substring(0, optionActive.length - 1))
    );
    $("#bdcbActive").html(
      cFLetter(optionActive.substring(0, optionActive.length - 1))
    );

    $(".nav-sidebar a").click(function (e) {
      e.preventDefault();
      $(this).addClass("active");
      $("#" + optionActive).removeClass("active");
      optionActive = $(this).attr("id");
      $("#bdcbTitle").html(
        cFLetter(optionActive.substring(0, optionActive.length - 1))
      );
      $("#bdcbActive").html(
        cFLetter(optionActive.substring(0, optionActive.length - 1))
      );
      url = $(this).attr("href");
      $.post(url, { url: url }, function (data) {
        if (url != "#") $(".content").html(data);
      });
    });
  };

  $("#profile").click(function (e) {
    e.preventDefault();
    optionActive = $(this).attr("id");
    $("#bdcbTitle").html(cFLetter(optionActive));
    $("#bdcbActive").html(cFLetter(optionActive));
    url = $(this).attr("href");
    $.post(url, { url: url }, function (data) {
      $(".content").html(data);
    });
  });

  const cFLetter = (str) => {
    str = str.charAt(0).toUpperCase() + str.slice(1);
    if (str.indexOf("_") > -1) str = str.replace(/_/g, " ");
    return str;
  };

  $(".ml-auto").on("click", "#logout", function () {
    logout();
  });

  redirectTo();
  optionsMenu();
  if (getName()) $("#dataName").html(getName());
}
