<?php
require_once('../../sesiones/sesion_admin.php');
/* include_once('../../../modals/modalNewCompany.php'); */
?>

<!doctype html>
<html lang="es">

<head>
	<?php include_once('../../../partials/admin_scripts.php'); ?>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php include_once('../../../partials/admin_sidebar.php'); ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php include_once('../../../partials/admin_header.php'); ?>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Administrador</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Empresas</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<!-- <button type="button" class="btn btn-primary">Crear Usuario Nuevo</button> -->
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateCompany">Crear Nueva Empresa</button>
							<!-- <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
							</div> -->
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableContactForm" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>id</th>
										<th>Formas de Contacto</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>

								</tbody>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<?php include_once('../../../partials/footer.php'); ?>

	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<?php include_once('../../../partials/darkmode.php'); ?>
	<!--end switcher-->

	<!-- Bootstrap JS -->
	<?php include_once('../../../partials/admin_scripts_js.php'); ?>
	<script src="../../js/config/contactforms.js"></script>
	<script src="js/global/validation.js"></script>
</body>

</html>