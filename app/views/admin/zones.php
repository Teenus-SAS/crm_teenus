<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Administrador</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Nueva Zona</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" id="btnNewZone">Nueva Zona</button>
		</div>
	</div>

</div>
<!--end breadcrumb-->
<hr />
<div class="card" id="zones">
	<div class="card-body gridx3">
		<label for="zone" class="mb-2">Nueva Zona</label>
		<input type="text" class="form-control" id="inZone" hidden>
		<input type="text" class="form-control" id="zone">
		<button class="btn btn-primary" id="btnCreateZone" style="width: 60%;">Crear Zona</button>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableZones" class="table table-striped table-bordered" style="width:100%">

			</table>
		</div>
	</div>
</div>

<script src="../app/js/config/zones.js"></script>
