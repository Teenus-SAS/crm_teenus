<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="/app/assets/images/icons/icon.jpg" type="image/png" />
	<!--plugins-->
	<link href="/app/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/app/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/app/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/app/assets/css/pace.min.css" rel="stylesheet" />
	<script src="/app/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="/app/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="/app/assets/css/app.css" rel="stylesheet">
	<link href="/app/assets/css/icons.css" rel="stylesheet">
	<!-- Notify -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet">
	<title>CRM-teenus</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<img src="/app/assets/images/logo/logo-teenus.png" width='130' alt="">
										<h2 class="mb-3 mt-3">Bienvenido</h2>
									</div>
									<hr />
									<div class="form-body">
										<form class="row g-3" id="autentication">
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Usuario</label>
												<input type="email" class="form-control" id="inputEmailAddress" name="inputEmailAddress" placeholder="Email">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="inputChoosePassword" name="inputChoosePassword" placeholder="Ingrese Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked">Recordarme</label>
												</div>
											</div>
											<div class="col-md-6 text-end"> <a href="app/views/login/forgot-password.php">¿Olvido el password?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="button" class="btn btn-primary" id="btnLogin"><i class="bx bxs-lock-open"></i>Ingresar</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="app/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="app/assets/js/jquery.min.js"></script>
	<script src="app/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="app/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="app/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="app/js/login/autentication.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function() {
			$("#show_hide_password a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="app/assets/js/app.js"></script>
</body>

</html>