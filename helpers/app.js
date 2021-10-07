const BASE_URL = "../../controller/";

function getFormData($form) {
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};
  $.map(unindexed_array, function (n) {
    indexed_array[n["name"]] = n["value"];
  });
  return indexed_array;
}

function loggedIn() {
  return !!localStorage.getItem("token");
}

function getToken() {
  return localStorage.getItem("token");
}

function getRedirectTo() {
  return JSON.parse(localStorage.getItem("setting")).redirectTo;
}

function getName() {
  return JSON.parse(localStorage.getItem("setting")).name;
}

function getPermits() {
  var permits = JSON.parse(localStorage.getItem("setting")).permits.split(',');
  permits.shift();
  return permits;
}

function createToken(token) {
  return 'Bearer ' + token;
}

function logout() {
  localStorage.removeItem("token");
  localStorage.removeItem("setting");
  location.href = "../auth/login";
}
