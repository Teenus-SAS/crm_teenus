<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalCompanies.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalReassignSeller.php';
?>

<!doctype html>
<html lang="es">

<head>
	<?php include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php'; ?>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php'; ?>
		</header>

		<!--navigation-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>

		<!--page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<?php if ($_SESSION['rol'] == 1) {  ?>
						<div class="breadcrumb-title pe-3">Direción Comercial</div>
					<?php } ?>

					<?php if ($_SESSION['rol'] == 2) {  ?>
						<div class="breadcrumb-title pe-3">Gestión Comercial</div>
					<?php } ?>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Empresas</li>
							</ol>
						</nav>
					</div>

					<?php if ($_SESSION['rol'] == 2) { ?>
						<div class="ms-auto">
							<div class="btn-group">
								<button type="button" class="btn btn-primary" id="btnCreateCompany" data-bs-toggle="modal" data-bs-target="#modalCreateCompany">Crear Nueva Empresa</button>
							</div>
						</div>
					<?php } ?>
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

		<!--overlay-->
		<div class="overlay toggle-icon"></div>

		<!--Back To Top Button-->
		<a href="javaScript:;" class="back-to-top noImprimir"><i class='bx bxs-up-arrow-alt'></i></a>

		<!-- footer -->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>
	</div>

	<!--switcher-->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php' ?>

	<!-- scripts -->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php' ?>


	<?php if ($_SESSION['rol'] == 2) { ?>
		<script src="/app/js/companies/companies.js"></script>
	<?php } ?>

	<script src="/app/js/companies/tblCompanies.js"></script>
	<script src="/app/js/companies/reassing.js"></script>
	<script src="/app/js/global/categories.js"></script>
	<script src="/app/js/global/sellers.js"></script>

	<script>
		tipo = "<?= $_SESSION['rol'] ?>"

		// $(document).ready(function() {
		// 	$(`#navContacts, #navCompanies, #navZonesAssigned`).click(function(e) {
		// 		e.preventDefault();
		// 		$('#menuContactLi').removeClass('mm-active');
		// 		$('#menuContactLu').removeClass('mm-show');
		// 		$(".menuContacts").attr("aria-expanded", false);

		// 	});
		// });
	</script>

</body>

</html>