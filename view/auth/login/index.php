<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ciudadano Sano | Log in</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="../../../assets/library/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../../assets/library/toastr/toastr.min.css">
        <link rel="stylesheet" href="../../../assets/css/adminlte.min.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Ciudadano</b>Sano</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Iniciar sesión</p>

                    <div class="row justify-content-center mb-2">
                        <img src="../../../assets/img/logo.png" alt="Ciudadano Sano Logo" width="100" style="opacity: .8">
                    </div>

                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div id="alert" class="alert alert-danger text-center" role="alert">
                            Unfilled fields please, place them.
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="signin" class="btn btn-danger btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>

                    <p class="mt-1">
                        <a href="../recover">I forgot my password</a>
                    </p>
                </div>
            </div>
        </div>

        <script src="../../../assets/library/jquery/jquery.min.js"></script>
        <script src="../../../assets/library/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../../assets/library/toastr/toastr.min.js"></script>
        <script src="../../../assets/js/adminlte.min.js"></script>
        <script src="./loginCtrl.js"></script>
        <script>
            $(document).ready(loginCtrl);
        </script>
    </body>
</html>
