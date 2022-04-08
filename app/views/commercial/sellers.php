<?php
session_start();
include_once '../../../modals/modalNewSeller.php';
include_once('../../../modals/modalReassignSeller.php');

?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Administrador</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Asesores Comerciales</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary btnCreateSeller" data-bs-toggle="modal" data-bs-target="#modalCreateSeller">Nuevo Asesor Comercial</button>
		</div>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableSellers" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>

<script src="../app/js/users/sellers.js"></script>
<script src="../app/js/global/sellers.js"></script>