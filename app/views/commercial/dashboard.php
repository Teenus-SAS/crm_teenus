<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
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
							<div class="col col-lg-4">
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
							<div class="col col-lg-4">
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
							<div class="col col-lg-4">
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
							<div class="col col-lg-4">
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
											<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 colorGoal"></i>Meta</span>
											<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 colorBill"></i>Facturación</span>
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
						<!-- Widget  
						<div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
							<div class="col-xl-2">
								<div class="card radius-10 border-start border-0 border-3 border-info">
									<div class="card-body">
										<div class="media align-items-center">
											<div class="media-body">
												<span class="text-muted text-uppercase font-size-12 font-weight-bold">Productos</span>
												<h2 class="mb-0 mt-1 text-info" id="products"></h2>
											</div>
											<div class="text-center">
												<div id="t-rev"></div>
												<span class="text-info font-weight-bold font-size-23">
													<i class='bx bxs-spreadsheet fs-xl'></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-2">
								<div class="card radius-10 border-start border-0 border-3 border-info">
									<div class="card-body">
										<div class="media align-items-center">
											<div class="media-body">
												<?php if ($_SESSION['flag_expense'] == 1 || $_SESSION['flag_expense'] == 0) { ?>
													<span class="text-muted text-uppercase font-size-12 font-weight-bold">Mat Primas</span>
												<?php } ?>
												<?php if ($_SESSION['flag_expense'] == 2) { ?>
													<span class="text-muted text-uppercase font-size-12 font-weight-bold">Materias Primas</span>
												<?php } ?>
												<h2 class="mb-0 mt-1 text-info" id="materials"></h2>
											</div>
											<div class="text-center">
												<div id="t-rev"></div>
												<span class="text-info font-weight-bold font-size-13">
													<i class='bx bxs-package fs-xl'></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col">
								<div class="card radius-10 border-start border-0 border-3 border-success">
									<div class="card-body">
										<div class="media align-items-center">
											<div class="media-body">
												<span class="text-muted text-uppercase font-size-12 font-weight-bold">Comisión de Vta</span>
												<h2 class="mb-0 mt-1 text-success" id="comissionAverage"></h2>
											</div>
											<div class="text-center">
												<div id="t-user"></div>
												<span class="text-success font-weight-bold font-size-13">
													<i class='bx bx-money fs-xl'></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3">
								<div class="card radius-10 border-start border-0 border-3 border-info">
									<div class="card-body">
										<div class="media align-items-center">
											<div class="media-body">
												<span class="text-muted text-uppercase font-size-12 font-weight-bold" id="expenses"></span>
												<h2 class="mb-0 mt-1 text-info" id="generalCost"></h2>
											</div>
											<div class="text-center">
												<div id="t-visitor"></div>
												<span class="text-danger font-weight-bold font-size-13">
													<i class='bx bxs-pie-chart-alt-2 fs-xl'></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card radius-10 border-start border-0 border-3 border-warning" style="height: 92px;">
									<div class="card-body">
										<div class="media align-items-center" style="height: 60px;">
											<div class="media-body">
												<span class="text-muted text-uppercase font-size-12 font-weight-bold">PTO EQUILIBRIO</span>
												<h2 class="mb-0 mt-1 text-warning" id="multiproducts"></h2>
											</div>
											<div class="chart-container" style="height:90px; width:90px">
												<canvas id="chartMultiproducts"></canvas>
												<div class="center-text">
													<h4 style="font-size: small;width: 60px;margin-left: 15px;" class="mb-0 font-weight-bold" id="percentageMultiproducts"></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->

						<!-- Row 2
						<div class="row align-items-stretch">
							<div class="pt-4 col-md-4 col-lg-3">
								<div class="card bg-success">
									<div class="card-body cardActualProfitability">
										<div class="media text-white">
											<div class="media-body">
												<span class="text-uppercase font-size-12 font-weight-bold">Rentabilidad Actual</span>
												<h2 class="mb-0 mt-1 text-white" id="actualProfitabilityAverage"></h2>
											</div>
											<div class="align-self-center mt-1">
												<i class="bx bx-line-chart fs-xl"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="card bg-warning">
									<div class="card-body">
										<div class="media text-white">
											<div class="media-body">
												<span class="text-uppercase font-size-12 font-weight-bold">Rentabilidad Mínima Deseada</span>
												<h2 class="mb-0 mt-1 text-white" id="profitabilityAverage"></h2>
											</div>
											<div class="align-self-center mt-1">
												<i class="bx bx-bar-chart-alt fs-xl"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body p-0">
										<ul class="list-group list-group-flush">
											<?php if ($_SESSION['flag_expense'] == 2 || $_SESSION['flag_expense'] == 0) { ?>
												<li class="list-group-item py-4" style="border-radius: 10px 10px 0 0;">
													<div class="media">
														<div class="media-body">
															<p class="text-muted mb-2">Tiempo Alistamiento (Prom)</p>
															<h4 class="mb-0 number" id="enlistmentTime"></h4>
														</div>
														<div class="avatar avatar-md bg-info mr-0 align-self-center">
															<i class="bx bxs-time fs-lg"></i>
														</div>
													</div>
												</li>
												<li class="list-group-item py-4">
													<div class="media">
														<div class="media-body">
															<p class="text-muted mb-2">Tiempo Operación (Prom)</p>
															<h4 class="mb-0 number" id="operationTime"></h4>
														</div>
														<div class="avatar avatar-md bg-primary mr-0 align-self-center">
															<i class="bx bxs-time-five fs-lg"></i>
														</div>
													</div>
												</li>
											<?php } ?>
											<li class="list-group-item py-4" style="border-radius: 0 0 10px 10px;">
												<div class="media">
													<div class="media-body">
														<p class="text-muted mb-2">Tiempo Promedio Fabricación</p>
														<h4 class="mb-0" id="averageTotalTime"></h4>
													</div>
													<div class="avatar avatar-md bg-danger mr-0 align-self-center">
														<i class='bx bx-error-circle fs-lg'></i>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-6">
								<div class="card">
									<div class="card-header dflex-between-center">
										<h5 class="card-title productTitle">Productos con mayor rentabilidad (Sugerida)</h5>
										<div class="text-center">
											<div class="mb-2">
												<button class="btn btn-sm btn-warning" id="btnGraphicProducts" style="width: 40px; height: 40px; padding: 10px 16px; border-radius: 35px; font-size: 24px; line-height: 1.33;">
													<i class="bi bi-bar-chart-fill" style="margin-left:-8px"></i>
												</button>
											</div>
											<div class="btn-group">
												<button class="btn btn-sm btn-primary typePrice" id="sugered" value="1">Sugerido</button>
												<button class="btn btn-sm btn-outline-primary typePrice" id="actual" value="2">Actual</button>
											</div>
										</div>
									</div>
									<div class="card-body chart-container">
										<canvas id="chartProductsCost" class="chart"></canvas>
									</div>
								</div>
							</div>
							<?php if ($_SESSION['flag_expense'] != 2) { ?>
								<div class="col-md-4 col-lg-3">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">Ventas</h5>
										</div>
										<div class="card-body p-0">
											<ul class="list-group list-group-flush">
												<li class="list-group-item py-4">
													<div class="media">
														<div class="media-body">
															<p class="text-muted mb-2">Total Unidades Vendidas</p>
															<h4 class="mb-0" id="productsSold"></h4>
														</div>
														<div class="avatar avatar-md bg-info mr-0 align-self-center">
															<i class="bx bx-layer fs-lg"></i>
														</div>
													</div>
												</li>
												<li class="list-group-item py-4">
													<div class="media">
														<div class="media-body">
															<p class="text-muted mb-2">Total Ingresos por Ventas</p>
															<h4 class="mb-0" id="salesRevenue"></h4>
														</div>
														<div class="avatar avatar-md bg-primary mr-0 align-self-center">
															<i class="bx bx-bar-chart-alt fs-lg"></i>
														</div>
													</div>
												</li>
												<li class="list-group-item py-4">
													<div class="media">
														<div class="media-body">
															<p class="text-muted mb-2">Rentabilidad Promedio</p>
															<h4 class="mb-0" id="profitabilityAverage"></h4>
														</div>
														<div class="avatar avatar-md bg-success mr-0 align-self-center">
															<i class="bx bx-chart fs-lg"></i>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							<?php } ?>
						</div> 

						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title">Costo Mano de Obra (Min)</h5>
									</div>
									<div class="card-body">
										<canvas id="chartWorkForceGeneral" style="width: 80%;"></canvas>
										<div class="center-text">
											<p class="text-muted mb-1 font-weight-600">Total Costo </p>
											<h4 class="mb-0 font-weight-bold" id="totalCostWorkforce"></h4>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title">Costo Carga Fabril</h5>
									</div>
									<div class="card-body">
										<div class="chart-container">
											<canvas id="chartFactoryLoadCost" style="width: 80%;"></canvas>
											<div class="center-text">
												<p class="text-muted mb-1 font-weight-600">Tiempo Total</p>
												<h4 class="mb-0 font-weight-bold" id="factoryLoadCost"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title">Gastos Generales</h5>
									</div>
									<div class="card-body pt-2">
										<div class="chart-container">
											<canvas id="chartExpensesGenerals" style="width: 80%;"></canvas>
											<div class="center-text">
												<p class="text-muted mb-1 font-weight-600">Total Gastos </p>
												<h4 class="mb-0 font-weight-bold" id="totalCost"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-12" style="height: fit-content;">
								<div class=" card">
									<div class="card-header">
										<h5 class="card-title">Tiempo Total de Fabricación por Producto (min)</h5>
									</div>
									<div class="card-body pt-2">
										<canvas id="chartTimeProcessProducts" style="width: 80%;"></canvas>
										<div class="center-text">
											<p class="text-muted mb-1 font-weight-600"></p>
											<h4 class="mb-0 font-weight-bold"></h4>
										</div>
									</div>
								</div>
							</div>
						</div> -->
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

	<script src="/app/js/indicators/indicators.js"></script>
	<script src="/app/js/global/sellers.js"></script>
	<script src="/app/js/global/profile.js"></script>
</body>

</html>