<!doctype html>
<html lang="es">

<head>
<?php 
	include_once dirname(dirname(dirname(__DIR__))) .'/modals/modalPaymentMethods.php';
	include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php';
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
				<li class="breadcrumb-item active" aria-current="page">Métodos de Pago</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" id="btnPaymentMethod">Nuevo Método de Pago</button>
		</div>
	</div>
</div>

<hr />

<div class="card" id="paymentMethods">
	<div class="card-body">
		<form class="gridx3" id="frmPaymentMethod">
			<label for="paymentMethod" class="mb-2">Nueva Forma de Pago</label>
			<input type="text" class="form-control" id="id_paymentMethod" name="id_paymentMethod" hidden>
			<input type="text" class="form-control" id="paymentMethod" name="paymentMethod">
			<button type="submit" class="btn btn-primary" id="btnCreatePaymentMethod" style="width: 60%;">Crear Forma de Pago</button>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tablePaymentMethods" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>id</th>
						<th>Condiciones de Pagos</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>

			</table>
		</div>
	</div>
</div>
<?php include_once dirname(dirname(dirname(__DIR__))) .'/partials/scripts_js.php'; ?>

<script src="../app/js/config/paymentmethods.js"></script>

</body>
</html>