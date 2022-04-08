<?php
session_start();
include_once('../../../modals/modalQuote.php');
include_once('../../../modals/modalOrder.php');
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
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
			</ol>
		</nav>
	</div>

	<?php if ($_SESSION['rol'] == 2) {  ?>
		<div class="ms-auto">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" id="btnNewQuote" data-bs-toggle="modal" data-bs-target="#modalCreateQuote">Crear Nueva Cotización</button>
			</div>
		</div>
	<?php } ?>

</div>

<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableQuotes" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>


<script src="../app/js/quotes/tblQuotes.js"></script>
<script src="../app/js/global/companies.js"></script>
<script src="../app/js/quotes/products.js"></script>
<script src="../app/js/quotes/quote.js"></script>
<script src="../app/js/global/business.js"></script>
<script src="../app/js/global/contact.js"></script>
<script src="../app/js/global/dateValidation.js"></script>
<script src="../app/js/global/number.js"></script>
<script src="../app/js/global/paymentMethods.js"></script>