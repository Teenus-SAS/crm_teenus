<?php 
require_once('../../sesiones/sesion_com.php');
include_once('../../../modals/modalCompanies.php') ?>
<!doctype html>
<html lang="es">

<head>
	<?php include_once('../../../partials/commercial_scripts_header.php'); ?>
	<title>Empresas - ProyecFormas</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once('../../../partials/commercial_header.php'); ?>
		</header>
		<!--end header -->
		<!--navigation-->
		<?php include_once('../../../partials/commercial_nav.php'); ?>
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Dirección Comercial</div>
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
							<button type="button" class="btn btn-primary" id="btnCreateCompany" data-bs-toggle="modal" data-bs-target="#modalCreateCompany">Crear Nueva Empresa</button>
						</div>
					</div>
				</div>

				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableCompanies" class="table table-striped table-bordered" style="width:100%">
								
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
	<?php include_once('../../../partials/darkmode.php') ?>
	<!--end switcher-->

	<!-- Scripts -->
	<?php include_once('../../../partials/commercial_scripts_js.php') ?>
	<script src="../../js/companies/companies.js"></script>
	<script src="../../js/global/companies.js"></script>

</body>

</html>