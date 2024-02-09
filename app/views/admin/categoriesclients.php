<!doctype html>
<html lang="es">
<?php
include_once dirname(dirname(dirname(__DIR__))) . '/modals/modalClientsCategories1.php';
include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_header.php';
?>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php'; ?>
		</header>
		<!--end header -->
		<!--navigation-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

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
							<select class="form-select selectCategory" name="selectCategory" id="selectCategory"></select>
							<input type="text" class="form-control" id="subcategory" name="subcategory">
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
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>
	</div>
	<!--end wrapper-->
	<?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php'; ?>
	<script src="../app/js/global/categories.js"></script>

	<script src="../app/js/config/categories.js"></script>
	<script src="../app/js/config/subcategories.js"></script>

	<script src="../app/js/config/tblCategories.js"></script>
	<script src="../app/js/config/tblCategoriesUnique.js"></script>
	<script src="../app/js/config/tblSubcategories.js"></script>

</body>

</html>