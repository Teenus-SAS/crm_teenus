<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalBusiness.php';
?>

<!DOCTYPE html>
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
				<!-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> -->
				<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
					<?php if ($_SESSION['rol'] == 1) {  ?>
						<div class="breadcrumb-title pe-3">Dirección Comercial</div>
					<?php } ?>

					<?php if ($_SESSION['rol'] == 2) {  ?>
						<div class="breadcrumb-title pe-3">Gestión Comercial</div>
					<?php } ?>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Proyectos</li>
							</ol>
						</nav>
					</div>


					<div class="ms-auto">
						<div class="btn-group">
							<a href="projects-kanban" type="button" class="btn btn-warning btn-img-bs"><i class='bx bx-category'></i></a>

							<?php if ($_SESSION['rol'] == 2) { ?>
								<button type="button" class="btn btn-primary" id="btnCreateBusiness" data-bs-toggle="modal" data-bs-target="#modalCreateBusiness">Crear Nuevo Proyecto</button>
							<?php }
							?>
						</div>
					</div>
				</div>

				<hr />
				<div class="card">
					<div class="row justify-content-end mt-2">
						<div class="col-sm-2">
							<label for="dateBusiness" class="form-label">Fecha</label>
							<input class="form-control" id="dateBusiness" type="date">
						</div>
						<div class="col-sm-1" style="margin-right:20px; margin-top:30px">
							<button type="button" class="btn btn-primary" id="btnClosedBusiness">Cerrados</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableBusiness" class="table table-striped table-bordered" style="width:100%">

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



	<?php
	$rol = $_SESSION['rol'];
	if ($rol == 1) { ?>
		<script src="../app/js/business/businessAll.js"></script>
		<script src="../app/js/global/sellers.js"></script>
	<?php } ?>

	<?php if ($rol == 2) { ?>
		<script src="../app/js/business/business.js"></script>
	<?php } ?>

	<script>
		tipo = "<?= $_SESSION['rol'] ?>"
	</script>

	<script src="../app/js/global/companies.js"></script>
	<script src="../app/js/global/number.js"></script>
	<script src="../app/js/business/tblBusiness.js"></script>

</body>

</html>