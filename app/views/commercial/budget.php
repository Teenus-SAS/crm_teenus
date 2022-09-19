<?php
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalBudgets.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php'; ?>
	<title>CRM-teenus</title>
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
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-money"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Presupuestos de Ventas</li>
							</ol>
						</nav>
					</div>

					<?php
					$rol = $_SESSION['rol'];
					if ($rol == 1) { ?>
						<div class="ms-auto">
							<div class="btn-group">
								<button type="button" class="btn btn-primary" id="btnCreateBusiness" data-bs-toggle="modal" data-bs-target="#modalCreateBudgets">Nuevo Presupuesto</button>
							</div>
						</div>
					<?php } ?>
				</div>

				<hr />
				<?php if ($rol == 1) { ?>
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="tableBudgets" class="table table-striped table-bordered" style="width:100%">
									<tbody></tbody>
									<tfoot>
										<tr>
											<th colspan="2" style="text-align:center"></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

				<?php } ?>

				<?php if ($rol == 2) { ?>
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="tableBudgets" class="table table-striped table-bordered" style="width:100%">

								</table>
							</div>
						</div>
					</div>
				<?php } ?>
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
		<script src="../app/js/budgets/resumenBudgets.js"></script>
		<script src="../app/js/global/sellers.js"></script>
	<?php } ?>

	<?php if ($rol == 2) { ?>
		<script src="../app/js/budgets/budgets.js"></script>
	<?php } ?>

	<script src="/app/assetscom/plugins/number/jquery.number.min.js"></script>
	<script src="/app/js/global/anio.js"></script>
	<script src="/app/js/global/number.js"></script>

</body>

</html>