<?php include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalRemission.php'; ?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Gestión Administrativa</div>

	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Pedidos 5</li>
			</ol>
		</nav>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableOrders" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="../app/js/remissions/createRemission.js"></script>