<!DOCTYPE html>
<html lang="es">

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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet">
	<title>CRM - Proyecformas</title>
</head>

<body class="bg-forgot">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">

			<div class="col-sm-3">

				<div class="text-center">
					<img src="../../assets/images/logo/logo-proyecformas.jpg" width="220" alt="" />
				</div>
				<h4 class="mt-5 font-weight-bold text-center">¿Olvido su password?</h4>
				<p class="text-muted text-center">Ingrese su email para enviar el password</p>
				<div class="my-4">
					<label class="form-label">Email</label>
					<input type="text" class="form-control form-control" placeholder="Email" id="email" />
				</div>
				<div class="d-grid gap-2">
					<button type="button" class="btn btn-primary" id="btnForgotPass">Enviar</button>
				</div>
				<div>
					<!-- <a href="../../../" class="btn btn-light mt-3"><i class='bx bx-arrow-back me-1'></i>Volver</a> -->
				</div>

			</div>
			<div class="col-sm-6" style="margin-left:50px;">

				<div>
					<img src="../../assets/images/login-images/bg-forgot-password3.png" width="100%" alt="">
				</div>

			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<script src="../../../app/assetscom/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script src="../../js/login/forgot-password.js"></script>
</body>

</html>