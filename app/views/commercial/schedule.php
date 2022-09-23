<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalTasks.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
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

		<!--navigation-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Gestión Comercial</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Agenda Comercial</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" id="btnModalTask" data-bs-toggle="modal" data-bs-target="#modalCreateTask"><i class="fadeIn animated bx bx-calendar-star"></i>Crear Nueva Actividad</button>
						</div>
					</div>
				</div>

				<hr />

				<div class="card">
					<div class="card-body">
						<ul class="nav nav-tabs nav-success" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#allTaks" role="tab" aria-selected="true">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-folder-open font-18 me-1'></i>
										</div>
										<div class="tab-title">Todas</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#alertTask" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-alarm-exclamation font-18 me-1'></i>
										</div>
										<div class="tab-title">Vencen Hoy</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#lateTask" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-alarm-off font-18 me-1'></i>
										</div>
										<div class="tab-title">Atrasadas</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#completedTask" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-task font-18 me-1'></i>
										</div>
										<div class="tab-title">Completadas</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="tab-content py-3">
							<div class="tab-pane fade show active" id="allTaks" role="tabpanel">
								<p>
								<div class="card">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tableSchedule" class="table table-striped table-bordered" style="width:100%">

											</table>
										</div>
									</div>
								</div>
								</p>
							</div>

							<div class="tab-pane fade" id="alertTask" role="tabpanel">
								<div class="card">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tableAlertTask" class="table table-striped table-bordered" style="width:100%">

											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="lateTask" role="tabpanel">
								<div class="card">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tableDelayTask" class="table table-striped table-bordered" style="width:100%">

											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="completedTask" role="tabpanel">
								<div class="card">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tableCompletedTask" class="table table-striped table-bordered" style="width:100%">

											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->

		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

		<!--Start footer-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>
	</div>
	<!--end wrapper-->

	<!--start switcher-->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php' ?>


	<!-- Scripts -->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php' ?>
	<script src="/app/js/schedule/schedule.js"></script>
	<script src="/app/js/global/companies.js"></script>

	<?php if ($_SESSION['rol'] == 2) {  ?>
	<?php } ?>
	</div>


	<script src="../app/js/schedule/tblsSchedule.js"></script>
	<script src="../app/js/schedule/schedule.js"></script>
	<script src="../app/js/global/companies.js"></script>
	<script src="../app/js/global/sellers.js"></script>
	<script src="../app/js/global/contact.js"></script>
	<script src="../app/js/global/dateValidation.js"></script>

	<script>
		tipo = "<?= $_SESSION['rol'] ?>"
	</script>

</body>

</html>