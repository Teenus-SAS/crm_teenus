<?php //require_once('sesiones/sesion_com.php'); 
?>
<!doctype html>
<html lang="es">

<head>
	<?php include_once('../partials/scripts_header.php'); ?>
	<title>CRM - ProyecFormas</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once('../partials/header.php'); ?>
		</header>

		<!--navigation-->
		<?php include_once('../partials/nav.php');
		?>

		<!--page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<?php //include_once('../app/views/commercial/orders.php'); 
				?>
			</div>
		</div>

		<!--overlay-->
		<div class="overlay toggle-icon"></div>

		<!--Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

		<!-- footer -->
		<?php include_once('../partials/footer.php'); ?>
	</div>

	<!--switcher-->
	<?php include_once('../partials/darkmode.php') ?>

	<!-- scripts -->
	<?php include_once('../partials/scripts_js.php') ?>
	<script src="/app/js/global/loadContent.js"></script>
	<script src="/app/js/global/profile.js"></script>
	<!-- <script src="/app/js/orders/tblOrders.js"></script> -->
	<!-- <script src="/app/js/orders/orders.js"></script> -->
	<script>
		tipo = "<?= $_SESSION['rol'] ?>"
		cargarContenido('page-content', 'views/commercial/orders.php')
	</script>
</body>

</html>