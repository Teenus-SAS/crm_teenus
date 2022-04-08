<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Administrador</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Nueva Categoria</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<div style="margin-right: 5px;">
				<button type="button" class="btn btn-primary" id="btnNewCategory">Crear Categoria</button>
			</div>
			<div>
				<button type="button" class="btn btn-warning" id="btnNewSubcategory">Crear Subcategoria</button>
			</div>
		</div>
	</div>
</div>

<div class="card" id="categories">
	<div class="card-body">
		<form class="gridx3" id="frmCategory">
			<label for="category" class="mb-2">Categoria</label>
			<input type="text" class="form-control" id="id_category" name="id_category" hidden>
			<input type="text" class="form-control" id="category" name="category">
			<button class="btn btn-primary" id="btnCreateCategory">Crear Categoria</button>
		</form>
	</div>
</div>

<div class="card" id="subcategories">
	<div class="card-body">
		<form class="gridx4" id="frmSubcategory">
			<label for="subcategory" class="mb-2">Subcategorias</label>
			<input type="text" class="form-control" id="id_subcategory" name="id_subcategory" hidden>
			<select class="form-select" name="selectCategory" id="selectCategory"></select>
			<input type="text" class="form-control" id="subcategory">
			<button class="btn btn-primary" id="btnCreatesubcategory">Crear Subcategorias</button>
		</form>
	</div>
</div>


<hr />

<div class="card" id="cardTableCategoriesUnique">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableCategoriesUnique" class="table table-striped table-bordered" style="width:100%">
				
			</table>
		</div>
	</div>
</div>

<div class="card" id="cardTableSubCategories">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableSubCategories" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>id</th>
						<th>SubCategoria</th>
						<th>Categorias</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>

			</table>
		</div>
	</div>
</div>

<div class="card" id="cardTableCategories">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tableCategories" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>id</th>
						<th>Categorias</th>
						<th>SubCategoria</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>

			</table>
		</div>
	</div>
</div>

<script src="../app/js/config/categories.js"></script>
<script src="../app/js/global/categories.js"></script>