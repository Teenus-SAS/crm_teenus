<?php
require_once('../../sesiones/sesion_com.php');
include_once('../../../modals/modalQuote.php') ?>
<!doctype html>
<html lang="en">

<head>
	<?php include_once('../../../partials/commercial_scripts_header.php'); ?>
	<title>Cotización - teenus</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<?php include_once('../../../partials/commercial_header.php'); ?>
		</header>
		<!--end header -->
		<!--navigation-->
		<?php include_once('../../../partials/commercial_nav.php'); ?>
		<!--end navigation-->
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
								<li class="breadcrumb-item active" aria-current="page">Cotización</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" id="btnCreateCompany" data-bs-toggle="modal" data-bs-target="#modalCreateQuote">Crear Nueva Cotización</button>
						</div>
					</div>
				</div>

				<hr />
				<div class="card">
					<div class="card-body">
						<div id="invoice">
							<div class="toolbar hidden-print">
								<div class="text-end">
									<button type="button" class="btn btn-secondary" onclick="window.print()"><i class="fa fa-print"></i>Imprimir</button>
									<button type="button" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> PDF</button>
									<button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Enviar</button>
								</div>
								<hr />
							</div>
							<div class="invoice overflow-auto">
								<div style="min-width: 600px">
									<header>
										<div class="row">
											<div class="col">
												<a href="javascript:;">
													<img src="../../assets/images/logo/logo-teenus.jpg" width="50%" alt="" />
												</a>
											</div>
											<div class="col company-details">
												<h2 class="name">
													<a href="javascript:;" style="color: #8DAC18;">teenus</a>
												</h2>
												<div>KM 3.5 via Funza - Siberia. Parque industrial San José (Bodega 1B / Manzana C)</div>
												<div>601 922 2830</div>
												<div>emoreno@teenus.com</div>
											</div>
										</div>
									</header>
									<main>
										<div class="row contacts">
											<div class="col invoice-to">
												<div class="text-gray-light">Cotizado a:</div>
												<h2 class="to">Lina Muñoz</h2>
												<div class="address">Sociedad de cirugia ocular</div>
												<div class="address">cr 16 # 97 - 46</div>
												<div class="email"><a href="mailto:john@example.com">compras@cirugiaocular.com.co</a>
												</div>
											</div>
											<div class="col invoice-details">
												<h1 class="invoice-id" style="color: #8DAC18;">COTIZACIÓN No 1000</h1>
												<div class="date">Fecha creación: 01/10/2021</div>
												<div class="date">Fecha vencimiento: 30/10/2021</div>
											</div>
										</div>
										<table>
											<thead>
												<tr>
													<th class="text-center"><b>REFERENCIA</b></th>
													<th class="text-center"><b>PRODUCTO</b></th>
													<th class="text-center"><b>DESCRIPCIÓN</b></th>
													<th class="text-center"><b>CANTIDAD</b></th>
													<th class="text-center"><b>VR. UNITARIO</b></th>
													<th class="text-center"><b>VR. TOTAL</b></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="">500-10-251-1</td>
													<td class="text-center"><img src="../../assets/images/products/500-10-251-1.png" alt="ORGANIZADOR MIXTO 2100MM 600MM 500MM"></td>
													<td class="text-left">
														<h3><a href="javascript:;" style="color: #8DAC18;">ORGANIZADOR MIXTO 2100MM 600MM 500MM</a></h3>
														<p>Organizador elaborado en: Frentes de cajon y puertas elaborados en supercor RH de 18 mm con canto rigido termofundido en contorno. Puertas abatibles con sistema de seguridad, cuenta con (2) entrepaños en su interior para almacenamiento. Las manijas de las puertas son incrustadas y estan elaboradas en aluminio anodizado. Cuenta con (7) cajones sencillos, cada cajon cuenta con (3) calles elaboradas en aluminio con (4) separadores en policarbonato por calle. Zocalo en aluminio y niveladores graduables en altura.
														</p>
													</td>
													<td class="text-center">1</td>
													<td class="text-end">$5.206.500</td>
													<td class="text-end">$5.206.500</td>
												</tr>

											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td colspan="3">SUBTOTAL</td>
													<td>$5.206.500</td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td colspan="3">IVA 19%</td>
													<td>$989.235</td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td colspan="3" style="color: #8DAC18;"><b>TOTAL</b></td>
													<td style="color: #8DAC18;"><b>$6.195.735</b></td>
												</tr>
											</tfoot>
										</table>
										<div class=""></div>
										<div class="notices mb-3">
											<div><b>Condiciones Comerciales:</b></div>
											<div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
										</div>
										<div class="notices mb-3">
											<div><b>Información para la Entrega:</b></div>
											<div class="notice">Fecha de Entrega: 10 dias habiles una vez recibida la orden de compra</div>
											<div class="notice">Dirección de Entrega: Av americas # 71C -29</div>
											<div class="notice">Contacto: Ricardo Cubillos </div>
											<div class="notice">Ciudad: Bogota D.C </div>
											<div class="notice">Teléfono: (601) 3586996 </div>
										</div>
										<div class="notices">
											<div><b>Observaciones Generales para el Despacho:</b></div>
											<div class="notice">El cliente deberá contar con área y espacio listo para la instalación.
												El cliente deberá confirmar datos exactos para la entrega: datos de contacto del responsable, dirección, horarios.
												teenus Ltda. no asume arreglos, instalaciones eléctricas o de obra civil. </div>
										</div>
									</main>
									<div class="mb-5 mt-5" style="margin-left: 30px;">
										<img src="../../assets/images/firmas/mlom.jpg" alt="" style="width:20%"><br>
										<label for="" style="font-size: large;"><b>Martha Lucia Olmos</b></label><br>
										<label for="" style="font-size: large;">teenus LTDA</label><br>
										<label for="" style="font-size: large;">3214989109</label>
									</div>
									<footer>Autorizo a teenus Ltda. para recaudar, almacenar, utilizar y actualizar mis datos personales con fines exclusivamente comerciales y garantizándome que esta información no será revelada a terceros salvo orden de autoridad competente. Ley 1581 de 2012, Decreto 1377 de 2013.</footer>
								</div>
								<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
								<div></div>
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

		<?php include_once('../../../partials/footer.php'); ?>
	</div>
	<!--end wrapper-->

	<!--start switcher-->
	<?php include_once('../../../partials/darkmode.php') ?>
	<!--end switcher-->

	<!-- Scripts -->
	<?php include_once('../../../partials/commercial_scripts_js.php') ?>
	<script src="../../js/companies/companies.js"></script>

</body>

</html>