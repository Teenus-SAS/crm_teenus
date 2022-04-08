<?php
session_start();
include_once('../../../modals/modalBusiness.php') ?>
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
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Proyectos</li>
			</ol>
		</nav>
	</div>


	<div class="ms-auto">
		<div class="btn-group">
			<a href="javascript:;" onclick="cargarContenido('page-content','views/commercial/business.php')" type="button" class="btn btn-warning btn-img-bs"><i class='bx bx-list-check'></i></a>
			<a href="javascript:;" onclick="cargarContenido('page-content','views/commercial/businessKanban.php')" type="button" class="btn btn-warning btn-img-bs"><i class='bx bx-category'></i></a>
			<?php if ($_SESSION['rol'] == 2) {  ?>
				<button type="button" class="btn btn-primary" id="btnCreateBusiness" data-bs-toggle="modal" data-bs-target="#modalCreateBusiness">Crear Nuevo Proyecto</button>
			<?php } ?>
		</div>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableBusiness" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>

<?php
$rol = $_SESSION['rol'];
if ($rol == 1) { ?>
	<script src="../app/js/business/businessAll.js"></script>
	<script src="../app/js/global/sellers.js"></script>
<?php } ?>

<?php if ($rol == 2) { ?>
	<script src="../app/js/business/business.js"></script>
<?php } ?>

<script src="../app/js/global/companies.js"></script>
<script src="../app/js/global/number.js"></script>
<script src="../app/js/business/tblBusiness.js"></script>