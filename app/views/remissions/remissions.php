<?php
session_start();
include_once('../../../modals/modalQuote.php');
include_once('../../../modals/modalOrder.php');
include_once '../../../modals/modalRemission.php';
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

	<div class="breadcrumb-title pe-3">Administración Comercial</div>

	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Remisiones</li>
			</ol>
		</nav>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableRemissions" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>


<script src="../app/js/remissions/remission.js"></script>
<script src="../app/js/remissions/tblRemissions.js"></script>
<script src="../app/js/global/updateDataDelivery.js"></script>