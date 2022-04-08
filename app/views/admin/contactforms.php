<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Administrador</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Empresas</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" id="btnContactForm">Nueva Forma de Contacto</button>
		</div>
	</div>
</div>

<hr />
<div class="card" id="contactForms">
	<div class="card-body">
		<form class="gridx3" id="frmContactForms">
			<label for="contactForm" class="mb-2">Nueva Forma de Contacto</label>
			<input type="text" class="form-control" id="id_contactForm" name="id_contactForm" hidden>
			<input type="text" class="form-control" id="contactForm" name="contactForm">
			<button class="btn btn-primary" id="btnCreateContactForm">Crear Forma de Contacto</button>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableContactForm" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>id</th>
						<th>Formas de Contacto</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>

			</table>
		</div>
	</div>
</div>

<script src="../app/js/config/contactforms.js"></script>