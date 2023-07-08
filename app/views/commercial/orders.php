<?php
if ($_SESSION['rol'] == 2) {
	include_once dirname(dirname(dirname(__DIR__))) .  '/modals/modalOrder.php';
	include_once dirname(dirname(dirname(__DIR__))) .  '/modals/modalRemission.php';
}
?>

<!doctype html>
<html lang="es">

<head>
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
						<div class="breadcrumb-title pe-3">Dirección Comercial</div>
					<?php } ?>

					<?php if ($_SESSION['rol'] == 2) {  ?>
						<div class="breadcrumb-title pe-3">Gestión Comercial</div>
					<?php } ?>

					<?php if ($_SESSION['rol'] == 3) {  ?>
						<div class="breadcrumb-title pe-3">Gestión Administrativa</div>
					<?php } ?>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Pedidos</li>
							</ol>
						</nav>
					</div>

					<?php //if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {  
					?>
					<!-- <div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" id="btnCreatePedido" data-bs-toggle="modal" data-bs-target="#modalCreatePedido">Crear Nuevo Pedido</button>
						</div>
					</div> -->
					<?php //} 
					?>

				</div>

				<hr />
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="tableOrders" class="table table-striped table-bordered" style="width:100%">
								<tbody></tbody>
								<tfoot>
									<tr>
										<th colspan="8" style="text-align:right">Total:</th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="/app/js/orders/tblOrders.js"></script>
		<script src="/app/js/orders/orders.js"></script>
		<script src="/app/js/global/companies.js"></script>
		<script src="/app/js/orders/products.js"></script>
		<script src="/app/js/global/dateValidation.js"></script>
		<script src="/app/js/global/number.js"></script>
		<script src="/app/js/global/updateDataDelivery.js"></script>
		<script src="/app/js/remissions/createRemission.js"></script>
	</div>
</body>

</html>