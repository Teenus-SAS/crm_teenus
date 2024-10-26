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
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Ventas Clientes</div>

					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" id="btnNewSaleClients">Crear Nuevo Cliente</button>
							<button type="button" class="btn btn-secondary" id="btnNewImportSaleClients">Importar Clientes</button>
						</div>
					</div>
				</div>

				<div class="cardImportSaleClients">
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

				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableSalesClients" class="table table-striped table-bordered" style="width:100%">

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

	<script src="/app/js/saleClients/tblSalesClients.js"></script>
	<script src="/app/js/saleClients/salesClients.js"></script>
	<script src="/app/js/import/import.js"></script>
	<script src="/app/js/saleClients/importSalesClients.js"></script>
	<script src="/app/js/import/file.js"></script>
</body>

</html>