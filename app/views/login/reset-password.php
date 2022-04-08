<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../../../app/assets/images/icons/icon.jpg" type="image/png" />
    <!-- loader-->
    <link href="../../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../../assets/css/app.css" rel="stylesheet">
    <link href="../../assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <title>Password | Proyecformas</title>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-5 border-end">
                                <div class="card-body">
                                    <form id="frmChangePasword">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <img src="../../assets/images/logo/logo-proyecformas.jpg" width="180" alt="">
                                            </div>
                                            <h4 class="mt-5 font-weight-bold">Genere su Nuevo Password</h4>
                                            <p class="text-muted">Recibimos su solicitud de restablecimiento de contraseña. Por favor ingrese su nueva contraseña!</p>
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">Nuevo Password</label>
                                                <input type="text" class="form-control" id="inputNewPass" name="inputNewPass" placeholder="Ingrese nuevo password" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirme Password</label>
                                                <input type="text" class="form-control" id="inputNewPass1" name="inputNewPass1" placeholder="Confirme password" />
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="button" id="btnChangePass" class="btn btn-primary">Cambiar Password</button>
                                                <!-- <a href="../../../../" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Volver al Login</a> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <img src="../../assets/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
    <script src="../../../app/assetscom/js/jquery.min.js"></script>
    <script src="../../js/login/reset-password.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</body>

</html>