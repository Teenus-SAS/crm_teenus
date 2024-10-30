<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalSalesClients.php';
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
				<!-- page header -->
				<div class="page-title-box">
					<div class="container-fluid">
						<div class="row align-items-center cardSClients">
							<div class="col-sm-5 col-xl-8">
								<div class="page-title">
									<h3 class="mb-1 font-weight-bold text-dark"><i class="fas fa-cogs mr-1"></i>Ventas Clientes</h3>
									<ol class="breadcrumb mb-3 mb-md-0">
										<li class="breadcrumb-item active">Creación de Clientes</li>
									</ol>
								</div>
							</div>
							<div class="col-sm-7 col-xl-4 btn-group form-inline justify-content-sm-end">
								<div class="col-xs-2" style="margin-right: 10px;">
									<button type="button" class="btn btn-primary" id="btnNewSaleClients">Crear Nuevo Cliente</button>
								</div>
								<div class="col-xs-2">
									<button type="button" class="btn btn-secondary" id="btnNewImportSaleClients">Importar Clientes</button>
								</div>
							</div>
						</div>
						<div class="row align-items-center cardGroups" style="display: none;">
							<div class="col-sm-5 col-xl-10">
								<div class="page-title">
									<h3 class="mb-1 font-weight-bold text-dark"><i class="fas fa-cogs mr-1"></i>Grupos</h3>
									<ol class="breadcrumb mb-3 mb-md-0">
										<li class="breadcrumb-item active">Creación de Grupos</li>
									</ol>
								</div>
							</div>
							<div class="col-sm-7 col-xl-2">
								<div class="col-xs-2 mr-2">
									<button class="btn btn-warning" id="btnNewGroup" name="btnNewGroup"><i class="bi bi-plus-circle mr-1"></i>Adicionar</button>
								</div>
								<!-- <div class="col-xs-2 py-2 mr-2">
									<button class="btn btn-info" id="btnNewImportAreas" name="btnNewImportAreas"><i class="bi bi-cloud-arrow-up-fill mr-1"></i>Importar</button>
								</div> -->
							</div>
						</div>
					</div>
				</div>

				<!-- Clientes -->
				<div class="page-content-wrapper mt--45 mb-5 cardImportSaleClients">
					<div class="container-fluid">
						<form class="col-12" id="formImportSaleClients" enctype="multipart/form-data">
							<div class="card">
								<div class="card-body">
									<div class="row" id="formSaleClients">
										<div class="col-sm-8 floating-label enable-floating-label show-label drag-area">
											<input class="form-control" type="file" id="fileSaleClient" accept=".xls,.xlsx">
											<!-- <label for="fileSaleClient" class="form-label"> Importar</label> -->
										</div>
										<div class="col-sm-1 cardBottons">
											<button type="text" class="btn btn-success" id="btnImportSaleClient">Importar</button>
										</div>
										<div class="col-sm-2 cardBottons">
											<button type="text" class="btn btn-info" id="btnDownloadImportsSaleClient">Descargar Formato</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<!-- Grupos -->
				<div class="page-content-wrapper mt--45 mb-5 cardCreateGroup">
					<div class="container-fluid">
						<form class="col-12" id="formAddGroup">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-10 floating-label enable-floating-label show-label">
											<label for="">Nombre</label>
											<input type="text" class="form-control" name="group" id="group">
										</div>
										<div class="col-sm mt-3">
											<button class="btn btn-success" id="btnAddGroup">Crear</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<hr />

				<div class="page-content-wrapper mt--45 mb-5">
					<div class="container-fluid">
						<div class="row">
							<ul class="nav nav-tabs" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active selectNavigation" id="link-clients" data-toggle="pill" href="javascript:;" role="tab" aria-controls="pills-projects" aria-selected="false">
										<i class="bi bi-diagram-3 mr-1"></i>Clientes
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link selectNavigation" id="link-groups" data-toggle="pill" href="javascript:;" role="tab" aria-controls="pills-activity" aria-selected="true">
										<i class="fas fa-cogs mr-1"></i>Grupos
									</a>
								</li>
							</ul>
						</div>
						<div class="row">
							<div class="card">
								<div class="tab-pane cardSClients">
									<div class="card-body">
										<div class="table-responsive">
											<table class="fixed-table-loading table table-hover" id="tableSalesClients"></table>
										</div>
									</div>
								</div>
								<div class="tab-pane cardGroups" style="display: none;">
									<div class="card-body">
										<div class="table-responsive">
											<div class="table-responsive">
												<table class="fixed-table-loading table table-hover" id="tableGroups"></table>
											</div>
										</div>
									</div>
								</div>
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

	<script src="/app/js/saleClients/tblSalesClients.js"></script>
	<script src="/app/js/saleClients/salesClients.js"></script>
	<script src="/app/js/group/configGroups.js"></script>
	<script src="/app/js/group/group.js"></script>
	<script src="/app/js/group/tblGroup.js"></script>
	<script src="/app/js/import/import.js"></script>
	<script src="/app/js/saleClients/importSalesClients.js"></script>
	<script src="/app/js/import/file.js"></script>
</body>

</html>