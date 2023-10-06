<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalBusiness.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php'; ?>
</head>

<body class="horizontal-navbar">
	<!-- Begin Page -->
	<div class="page-wrapper">
		<!--start header -->
		<header>
			<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php'; ?>
		</header>

		<!-- Begin Left Navigation -->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>

		<!-- Begin main content -->
		<div class="main-content">
			<!-- content -->
			<div class="page-content">
				<!-- page header 
				<div class="page-title-box">
					<div class="container-fluid">
						<div class="row align-items-center">
							<div class="col-sm-5 col-xl-6">
								<div class="page-title">
									<h3 class="mb-1 font-weight-bold text-dark">Dashboard Consolidado</h3>
									<ol class="breadcrumb mb-3 mb-md-0">
										<li class="breadcrumb-item active">Bienvenido</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!-- page content -->
				<div class="page-content-wrapper mt--45">
					<div class="container-fluid">
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
							<?php if ($_SESSION['rol'] == 1) {  ?>
								<!-- <div class="breadcrumb-title pe-3">Direción Comercial</div> -->
							<?php } ?>

							<?php if ($_SESSION['rol'] == 2) {  ?>
								<!-- <div class="breadcrumb-title pe-3">Gestión Comercial</div> -->
							<?php } ?>

							<!-- <div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-money"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Presupuestos de Ventas</li>
							</ol>
						</nav>
					</div> -->
						</div>

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
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Proyectos</li>
									</ol>
								</nav>
							</div>

							<div class="ms-auto">
								<div class="btn-group">
									<a href="projects" type="button" class="btn btn-warning btn-img-bs"><i class='bx bx-list-check' style="margin-left: 3px;font-size: 1.5em;margin-top:-5px"></i></a>

									<?php if ($_SESSION['rol'] == 2) {  ?>
										<button type="button" class="btn btn-primary" id="btnCreateBusiness" data-bs-toggle="modal" data-bs-target="#modalCreateBusiness">Crear Nuevo Proyecto</button>
									<?php } ?>
								</div>
							</div>
						</div>

						<hr />
						<?php
						$rol = $_SESSION['rol'];
						if ($rol == 1) { ?>
							<div class="search-bar flex-grow-1" style="width: 50%;">
								<div class="position-relative search-bar-box" style="display: flex;">
									<label for="">Asesor Comercial</label>
									<select class="form-select selectSellerKanban" name="seller" id="selectSellerKanban"></select>
								</div>
							</div>
							<hr>

						<?php } ?>

						<div id="board_business" class="row py-3"></div>

					</div>
				</div>
			</div>
		</div>
		<!-- main content End -->

		<!--overlay-->
		<div class="overlay toggle-icon"></div>
		<!--Back To Top Button-->
		<a href="javaScript:;" class="back-to-top noImprimir"><i class='bx bxs-up-arrow-alt'></i></a>

		<!-- footer -->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>

	</div>
	<!-- Page End -->

	<!--switcher-->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php' ?>

	<!-- scripts -->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php' ?>

	<script src="/app/js/business/business.js"></script>
	<script src="/app/js/business/businessKanban.js"></script>
	<script src="../app/js/global/salesPhase.js"></script>

	<script src="/app/js/global/sellers.js"></script>
	<script src="/app/js/global/companies.js"></script>
</body>

</html>