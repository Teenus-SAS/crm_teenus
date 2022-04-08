<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets-commercial/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets-commercial/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets-commercial/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets-commercial/css/pace.min.css" rel="stylesheet" />
	<script src="assets-commercial/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets-commercial/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets-commercial/css/app.css" rel="stylesheet">
	<link href="assets-commercial/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets-commercial/css/dark-theme.css" />
	<link rel="stylesheet" href="assets-commercial/css/semi-dark.css" />
	<link rel="stylesheet" href="assets-commercial/css/header-colors.css" />
	<title>Gestión Comercial - ProyecFormas</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once('../partials/headerCommercial.php') ?>
		</header>
		<!--end header -->
		<!--navigation-->
		<?php include_once('../partials/nav-commercial.php') ?>
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Commercial</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">To Do List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="card">
					<div class="card-body">
						<h4 class="mb-0">To Do List</h4>
						<hr />
						<div class="row gy-3">
							<div class="col-md-10">
								<input id="todo-input" type="text" class="form-control" value="">
							</div>
							<div class="col-md-2 text-end d-grid">
								<button type="button" onclick="CreateTodo();" class="btn btn-primary">Add todo</button>
							</div>
						</div>
						<div class="form-row mt-3">
							<div class="col-12">
								<div id="todo-container"></div>
							</div>
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
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr />
			<h6 class="mb-0">Theme Styles</h6>
			<hr />
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr />
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr />
			<h6 class="mb-0">Header Colors</h6>
			<hr />
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	<script>
		// to do list 
		var todos = [{
			text: "take out the trash",
			done: false,
			id: 0
		}];
		var currentTodo = {
			text: "",
			done: false,
			id: 0
		}
		document.getElementById("todo-input").oninput = function(e) {
			currentTodo.text = e.target.value;
		};
		/*
			//jQuery Version
			$('#todo-input').on('input',function(e){
				currentTodo.text = e.target.value;
			   });
			*/
		function DrawTodo(todo) {
			var newTodoHTML = `
			<div class="pb-3 todo-item" todo-id="${todo.id}">
				<div class="input-group">
					
						<div class="input-group-text">
							<input type="checkbox" onchange="TodoChecked(${todo.id})" aria-label="Checkbox for following text input" ${todo.done&& "checked"}>
						</div>
					
					<input type="text" readonly class="form-control ${todo.done&&" todo-done "} " aria-label="Text input with checkbox" value="${todo.text}">
					
						<button todo-id="${todo.id}" class="btn btn-outline-secondary bg-danger text-white" type="button" onclick="DeleteTodo(this);" id="button-addon2 ">X</button>
					
				</div>
			</div>
			  `;
			var dummy = document.createElement("DIV");
			dummy.innerHTML = newTodoHTML;
			document.getElementById("todo-container").appendChild(dummy.children[0]);
			/*
				//jQuery version
				 var newTodo = $.parseHTML(newTodoHTML);
				 $("#todo-container").append(newTodo);
				*/
		}

		function RenderAllTodos() {
			var container = document.getElementById("todo-container");
			while (container.firstChild) {
				container.removeChild(container.firstChild);
			}
			/*
				//jQuery version
				  $("todo-container").empty();
				*/
			for (var i = 0; i < todos.length; i++) {
				DrawTodo(todos[i]);
			}
		}
		RenderAllTodos();

		function DeleteTodo(button) {
			var deleteID = parseInt(button.getAttribute("todo-id"));
			/*
				//jQuery version
				  var deleteID = parseInt($(button).attr("todo-id"));
				*/
			for (let i = 0; i < todos.length; i++) {
				if (todos[i].id === deleteID) {
					todos.splice(i, 1);
					RenderAllTodos();
					break;
				}
			}
		}

		function TodoChecked(id) {
			todos[id].done = !todos[id].done;
			RenderAllTodos();
		}

		function CreateTodo() {
			newtodo = {
				text: currentTodo.text,
				done: false,
				id: todos.length
			}
			todos.push(newtodo);
			RenderAllTodos();
		}
	</script>
</body>

</html>