<!doctype html>
<html lang="es">

<head>
<?php
	include_once dirname(dirname(dirname(__DIR__))) .'/modals/modalSalesChannels1.php';
	include_once dirname(dirname(dirname(__DIR__))) .'/partials/scripts_header.php';
?>
</head>


<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php'; ?>
		</header>
		<!--end header -->
		<!--navigation-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>
		<!--end navigation-->
		<!--start page wrapper -->
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>
	</div>
	<!--end wrapper-->


<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Administrador</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Canales de Venta</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" id="btnSaleChannel">Nuevo Canal de Venta</button>
		</div>
	</div>
</div>

<div class="card" id="salesChannels">
	<div class="card-body">
		<form class="gridx3" id="frmSaleChannels">
			<label for="saleChannel">Nuevo Canal de Venta</label>
			<input type="text" class="form-control" id="id_saleChannel" name="id_saleChannel" hidden>
			<input type="text" class="form-control" id="saleChannel" name="saleChannel">
			<button class="btn btn-primary" id="btnCreteSaleChannel" style="width: 60%;">Crear Canal de Venta</button>
		</form>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableSalesChannels" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>id</th>
						<th>Canal de Venta</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>

			</table>
		</div>
	</div>
</div>

<script src="../app/js/config/salechannels.js"></script>


</body>
</html>