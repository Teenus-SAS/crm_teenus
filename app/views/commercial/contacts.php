<?php
include_once dirname(dirname(dirname(__DIR__))) .'/modals/modalContact.php';
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
				</div>
			</div>
		</div>
	</div>
	
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
				<li class="breadcrumb-item active" aria-current="page">Contactos</li>
			</ol>
		</nav>
	</div>
	<?php if ($_SESSION['rol'] == 2) { ?>
		<div class="ms-auto">
			<div class="btn-group">
				<!-- <button type="button" class="btn btn-primary">Crear Nuevo Contacto</button> -->
				<button type="button" class="btn btn-primary" id="btnCreateContact" data-bs-toggle="modal" data-bs-target="#modalCreateContact">Crear Nuevo Contacto</button>
			</div>
		</div>
	<?php } ?>
</div>

<hr />

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableContacts" class="table table-striped table-bordered" style="width:100%">
			</table>
		</div>
	</div>
</div>

<script src="/app/js/contacts/tblContacts.js"></script>
<script src="/app/js/contacts/contacts.js"></script>
<script src="/app/js/global/companies.js"></script>

</body>
</html>
