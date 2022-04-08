<?php
session_start();
include_once '../../../modals/modalBudgets.php';
?>

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
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-money"></i></a>
				</li>
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
<!-- <div class="row">
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

</div> -->

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