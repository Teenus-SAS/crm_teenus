<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalBusiness.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php'; ?>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/rowgroup/1.4.1/css/rowGroup.bootstrap.min.css" />
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
				<!-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> -->
				<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
					<?php if ($_SESSION['rol'] == 1) {  ?>
						<div class="breadcrumb-title pe-3">Dirección Comercial</div>
					<?php } ?>

					<?php if ($_SESSION['rol'] == 2) {  ?>
						<div class="breadcrumb-title pe-3">Gestión Comercial</div>
					<?php } ?>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Proyectos</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="projects-kanban" type="button" class="btn btn-warning btn-img-bs"><i class='bx bx-category'></i></a>
							<a href="javascript:;" id="btnSearchDate" type="button" class="btn btn-warning btn-img-bs"><i class='bi bi-search'></i></a>

							<?php if ($_SESSION['rol'] == 2) { ?>
								<button type="button" class="btn btn-primary" id="btnCreateBusiness" data-bs-toggle="modal" data-bs-target="#modalCreateBusiness">Crear Nuevo Proyecto</button>
							<?php }
							?>
						</div>
					</div>
				</div>

				<div class="card cardSearchDate">
					<div class="card-body">
						<div class="row justify-content-end">
							<div class="col-sm-2">
								<label for="minDate" class="form-label">Fecha Inicial</label>
								<input class="form-control dateBusiness" id="minDate" type="date">
							</div>
							<div class="col-sm-2">
								<label for="maxDate" class="form-label">Fecha Final</label>
								<input class="form-control dateBusiness" id="maxDate" type="date">
							</div>
							<div class="col-sm-1" style="margin-right:20px; margin-top:30px">
								<button type="button" class="btn btn-primary" id="btnClosedBusiness">Cerrados</button>
							</div>
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
			</div>
		</div>

		<!--overlay-->
		<div class="overlay toggle-icon"></div>

		<!--Back To Top Button-->
		<a href="javaScript:;" class="back-to-top noImprimir"><i class='bx bxs-up-arrow-alt'></i></a>

		<!-- footer -->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>

	</div>

	<!--switcher-->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php' ?>

	<!-- scripts -->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php' ?>



	<?php
	$rol = $_SESSION['rol'];
	if ($rol == 1) { ?>
		<script src="../app/js/business/businessAll.js"></script>
		<script src="../app/js/global/sellers.js"></script>
	<?php } ?>

	<?php if ($rol == 2) { ?>
		<script src="../app/js/business/business.js"></script>
	<?php } ?>

	<script>
		tipo = "<?= $_SESSION['rol'] ?>";

		$(document).ready(function() {
			$('.cardSearchDate').hide();

			$('#btnSearchDate').click(function(e) {
				e.preventDefault();

				$('.cardSearchDate').toggle(800);
			});

			$('#btnClosedBusiness').click(function(e) {
				e.preventDefault();

				tableBusiness.column(1).search('').draw();
				tableBusiness.column(6).search('Ganado').draw();
			});

			loadDateBusiness = () => {
				let date = new Date().toISOString().split('T')[0];

				$('#maxDate').val(date);

				let maxDate = document.getElementById('maxDate');
				let minDate = document.getElementById('minDate');

				maxDate.setAttribute("max", date);
				minDate.setAttribute("max", date);
			}

			$(document).on('change', '.dateBusiness', async function(e) {
				e.preventDefault();

				let dateBusiness = document.getElementsByClassName('dateBusiness');
				let status = true;

				for (let i = 0; i < dateBusiness.length; i++) {
					if (dateBusiness[i].value == '') {
						status = false;
						break;
					}
				}

				if (status == false) {
					toastr.error('Ingrese Fecha Inicial y Fecha Final');
				} else {
					loadTblBusiness(dateBusiness[0].value, dateBusiness[1].value);
				}
			});

			loadDateBusiness();

			$('#btnCreateBusiness').click(function(e) {
				e.preventDefault();
				$('.generalInputs').prop('disabled', false);
				let inputsBills = document.getElementsByClassName('inputsBill');

				while (inputsBills.length > 0) {
					inputsBills[0].remove();
				}

			});

		})
	</script>

	<script src="../app/js/global/companies.js"></script>
	<script src="../app/js/global/contact.js"></script>
	<script src="../app/js/global/salesPhase.js"></script>
	<script src="../app/js/global/number.js"></script>
	<script src="../app/js/business/tblBusiness.js"></script>
	<script src="//cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script>

</body>

</html>