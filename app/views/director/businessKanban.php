<?php
require_once('../../sesiones/sesion_com.php');
include_once('../../../modals/modalBusiness.php') ?>
<!doctype html>
<html lang="es">

<head>
	<?php include_once('../../../partials/commercial_scripts_header.php'); ?>
	<title>Proyectos - ProyecFormas</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once('../../../partials/commercial_header.php'); ?>
		</header>

		<!--navigation-->
		<?php include_once('../../../partials/commercial_nav.php'); ?>

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Dirección Comercial</div>
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
							<a href="business.php" type="button" class="btn btn-warning" style="margin-right: 5px;border-radius: 3px;"><i class='bx bx-list-check' style="margin-top: -5px;margin-left: 3px;font-size: 1.5em;"></i></a>
							<a href="businessKanban.php" type="button" class="btn btn-warning" style="margin-right: 5px;border-radius: 3px;"><i class='bx bx-category' style="margin-top: -5px;margin-left: 3px;font-size: 1.5em;"></i></a>
							<button type="button" class="btn btn-primary" id="btnCreateBusiness" data-bs-toggle="modal" data-bs-target="#modalCreateBusiness">Crear Nuevo Proyecto</button>
						</div>
					</div>
				</div>
				<hr />

				<div id="board_business" style="display: flex;grid-gap:1em"></div>
			</div>
		</div>
	</div>

	<!--start overlay-->
	<div class="overlay toggle-icon"></div>

	<!--Start Back To Top Button-->
	<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

	<?php include_once('../../../partials/footer.php'); ?>
	</div>

	<!--start switcher-->
	<?php include_once('../../../partials/darkmode.php') ?>

	<!-- Scripts -->
	<?php include_once('../../../partials/commercial_scripts_js.php') ?>
	<script src="../../js/business/business.js"></script>
	<script src="../../js/business/businessKanban.js"></script>
	<script src="../../js/global/companies.js"></script>

</body>

</html>