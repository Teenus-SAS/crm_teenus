<?php session_start();
include_once '../../../modals/modalTasks.php';
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
				<li class="breadcrumb-item active" aria-current="page">Agenda Comercial</li>
			</ol>
		</nav>
	</div>
	<?php if ($_SESSION['rol'] == 2) {  ?>
		<div class="ms-auto">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" id="btnModalTask" data-bs-toggle="modal" data-bs-target="#modalCreateTask"><i class="fadeIn animated bx bx-calendar-star"></i>Crear Nueva Actividad</button>
			</div>
		</div>
	<?php } ?>
</div>

<hr />
<?php if ($_SESSION['rol'] == 1) {  ?>
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
								<table id="tableScheduleAll" class="table table-striped table-bordered" style="width:100%">

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
								<table id="tableAlertTaskAll" class="table table-striped table-bordered" style="width:100%">

								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="lateTask" role="tabpanel">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="tableDelayTaskAll" class="table table-striped table-bordered" style="width:100%">

								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="completedTask" role="tabpanel">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="tableCompletedTaskAll" class="table table-striped table-bordered" style="width:100%">

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php if ($_SESSION['rol'] == 2) {  ?>
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
<?php } ?>

<?php if ($_SESSION['rol'] == 1) {  ?>
	<script src="../app/js/schedule/scheduleAll.js"></script>
<?php } ?>

<?php if ($_SESSION['rol'] == 2) {  ?>
	<script src="../app/js/schedule/tblsSchedule.js"></script>
<?php } ?>

<script src="../app/js/schedule/schedule.js"></script>
<script src="../app/js/global/companies.js"></script>
<script src="../app/js/global/sellers.js"></script>
<script src="../app/js/global/contact.js"></script>