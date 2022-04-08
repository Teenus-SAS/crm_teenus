<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Dirección Comercial</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Asignar Zonas</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" id="btnNewZoneAssigned">Asignar Zonas</button>
		</div>
	</div>

</div>
<!--end breadcrumb-->
<hr />
<div class="card" id="zonesAssigned">
	<div class="card-body">
		<form class="gridx3" id="formAssignedZone">
			<label for="zone" class="mb-2">Zona</label>
			<label for="zone" class="mb-2">Asesor Comercial</label>
			<div></div>
			<input type="text" class="from-control" id="id_assignedZone" name="id_assignedZone" hidden>
			<select class="form-select selectZone" name="zone" id="zone"></select>
			<select class="form-select selectSeller" name="seller" id="seller"></select>
			<button class="btn btn-primary" id="btnCreateZoneAssigned" style="width: 60%;">Crear Nueva Asignación</button>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableZonesAssigned" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>

<script src="../app/js/config/zonesAssigned.js"></script>
<script src="../app/js/global/sellers.js"></script>
<script src="../app/js/global/zones.js"></script>