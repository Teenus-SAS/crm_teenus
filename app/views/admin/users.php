<!doctype html>
<html lang="es">

<head>

	<?php
	include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalNewSeller.php';
	include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_header.php';
	?>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">

		<!--start header -->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php' ?>
		<!--navigation-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Administrador</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Usuarios</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" id="btnNewUser" data-bs-toggle="modal" data-bs-target="#modalCreateUser">Crear Nuevo Usuario</button>
						</div>
					</div>
				</div>

				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableUsers" class="table table-striped table-bordered" style="width:100%">

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>

		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>

	</div>
	<!--start switcher-->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php'; ?>

	<!-- Bootstrap JS -->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php'; ?>

	<script src="js/global/validation.js"></script>
	<script src="../app/js/users/users.js"></script>


</body>

</html>