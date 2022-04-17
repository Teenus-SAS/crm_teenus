<?php require_once('../../sesiones/sesion_com.php'); ?>
<!doctype html>
<html lang="es">

<head>
	<?php include_once('../../../partials/commercial_scripts_header.php'); ?>
	<title>Presupuesto - teenus</title>
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
					<div class="breadcrumb-title pe-3">Gestión Comercial</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-money"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Presupuesto</li>
							</ol>
						</nav>
					</div>
					<!-- <div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Crear Nueva Empresa</button>
						</div>
					</div> -->
				</div>
				<!--end breadcrumb-->
				<!-- <h6 class="mb-0 text-uppercase">Empresas</h6> -->
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableBudgets" class="table table-striped table-bordered" style="width:100%">
								
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-12">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-3">Presupuesto de ventas mes a mes</h6>
									</div>
								</div>
								<div class="chart-container-1">
									<canvas id="chart1"></canvas>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!--end row-->

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
	<script src="../../js/budgets/budgets.js"></script>

</body>

</html>