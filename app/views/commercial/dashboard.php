<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
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
				<?php
				//session_start();
				$rol = $_SESSION['rol'];
				if ($rol == 1) {
				?>
					<div class="mb-3">
						<div class="col-md-3">
							<label for="">Asesor Comercial</label>
							<select class="form-select selectSeller" name="selectSeller" id="selectSeller"></select>
						</div>
					</div>
				<?php } ?>
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-info">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Clientes Nuevos</p>
										<h4 class="my-1 text-info newCustomers"></h4>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bx-user-plus'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-danger">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Proyectos Nuevos</p>
										<h4 class="my-1 text-info newBusiness"></h4>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-success">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Valorizado Proyectos Mensual</p>
										<h4 class="my-1 text-warning valuedBusinessMonth"></h4>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
										<i class='bx bxs-bar-chart-alt-2'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="g-col-md-4">
						<div class="card radius-10 border-start border-0 border-3 border-success">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Valorizado Proyectos Anual</p>
										<h4 class="my-1 text-warning valuedBusinessAnnual"></h4>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
										<i class='bx bxs-bar-chart-alt-2'></i>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-warning">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Facturación Mensual</p>
										<h4 class="my-1 text-success valuedBillsMonth"></h4>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-group'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-warning">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Facturación Anual</p>
										<h4 class="my-1 text-success valuedOrdersAnnual"></h4>
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-group'></i>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
				<!--end row-->

				<div class="row">
					<div class="col-9 col-lg-9">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Presupuesto vs Facturación</h6>
									</div>
								</div>
								<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 colorBudgets"></i>Presupuesto</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 colorOrders"></i>Facturacion</span>
								</div>
								<div class="chart-container-1">
									<canvas id="budgetsvsorders"></canvas>
								</div>
							</div>

						</div>
					</div>
					<div class="col-3 col-lg-3">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Meta Facturación</h6>
									</div>
								</div>
								<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 colorBudgets"></i>Meta</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 colorOrders"></i>Facturación</span>
								</div>
								<div class="chart-container-1">
									<canvas id="goalBilling"></canvas>
								</div>
							</div>

						</div>
					</div>
					<div class="col-12 col-lg-6">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Clientes</h6>
									</div>
								</div>
								<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 newCustomersMonth"></i>Nuevos Clientes</span>
								</div>
								<div class="chart-container-1">
									<canvas id="quantityCustomers"></canvas>
								</div>
							</div>

						</div>
					</div>

					<div class="col-12 col-lg-6">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Proyectos</h6>
									</div>
								</div>
								<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 winBusiness"></i>Ganados</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 lostBusiness"></i>Perdidos</span>
								</div>
								<div class="chart-container-1">
									<canvas id="quantityBusiness"></canvas>
								</div>
							</div>

						</div>
					</div>

					<div class="col-12 col-lg-6">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Valorizado Proyectos</h6>
									</div>
								</div>
								<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 winValuedBusiness"></i>Ganados</span>
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 lostValuedBusiness"></i>Perdidos</span>
								</div>
								<div class="chart-container-1">
									<canvas id="valuedBusiness"></canvas>
								</div>
							</div>

						</div>
					</div>

					<div class="col-12 col-lg-6">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Valorizado Facturacion</h6>
									</div>
								</div>
								<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
									<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 valuedOrdersInd"></i>Facturacion</span>
									<!-- <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Perdidos</span> -->
								</div>
								<div class="chart-container-1">
									<canvas id="valuedOrders"></canvas>
								</div>
							</div>

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

	<script src="/app/js/indicators/indicators.js"></script>
	<script src="/app/js/global/sellers.js"></script>
	<script src="/app/js/global/profile.js"></script>
</body>

</html>