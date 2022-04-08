<?php session_start();  ?>
<div class="page-breadcrumb noImprimir d-none d-sm-flex align-items-center mb-3">
	<?php if ($_SESSION['rol'] == 1) {  ?>
		<div class="breadcrumb-title noImprimir pe-3">Direción Comercial</div>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 2) {  ?>
		<div class="breadcrumb-title noImprimir pe-3">Gestión Comercial</div>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 3) {  ?>
		<div class="breadcrumb-title noImprimir pe-3">Gestión Administrativa</div>
	<?php } ?>

	<div class="ps-3 noImprimir">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Pedido</li>
			</ol>
		</nav>
	</div>

	<?php if ($_SESSION['rol'] == 1) {  ?>
		<!-- <div class="ms-auto">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" id="btnCreateCompany" data-bs-toggle="modal" data-bs-target="#modalCreateQuote">Crear Nuevo Pedido</button>
			</div>
		</div> -->
	<?php } ?>
</div>

<hr class="noImprimir" />
<div class="card">
	<div class="card-body">
		<div id="invoice">
			<div class="toolbar hidden-print">
				<div class="text-end">
					<button type="button" class="btn btn-warning btnPrint" onclick="window.print()"><i class="fa fa-print"></i>Imprimir</button>
				</div>
				<hr class="noImprimir" />
			</div>
			<div class="invoice overflow-auto">
				<div style="min-width: 600px">
					<div>
						<div class="row">
							<div class="col">
								<a href="javascript:;">
									<img src="../app/assets/images/logo/logo-proyecformas.jpg" id="logo-proyecformas" width="50%" alt="" />
								</a>
							</div>
							<div class="col company-details">
								<div><b>KM 3.5 via Funza - Siberia. Parque industrial San José (Bodega 1B / Manzana C)</b></div>
								<div><b>NIT: 830074655-2</b></div>
							</div>
						</div>
					</div>

					<hr>

					<main>
						<div class="row contacts">
							<div class="col invoice-to">
								<div class="text-gray-light">Cotizado a:</div>
								<h3 class="company mb-0"></h3>
								<h6 class="nit mb-0"></h6>
								<h6 class="to mb-0"></h6>
								<h6 class="address mb-0"></h6>
								<h6 class="email"></h6>
							</div>
							<div class="col invoice-details">
								<h2 class="order_id" style="color: #8DAC18;">
									</h1>
									<h2 class="quote_id" style="color: #8DAC18;"></h2>
									<div class="dateCreation"></div>
									<div class="purchaseOrder"></div>
							</div>
						</div>
						<hr>
						<h3 class="business">PROYECTO:</h3>
						<hr>
						<table>
							<thead>
								<tr>
									<th class="text-center"><b>REFERENCIA</b></th>
									<th class="text-center"><b>PRODUCTO</b></th>
									<th class="text-center"><b>DESCRIPCIÓN</b></th>
									<th class="text-center"><b>CANTIDAD</b></th>
									<th class="text-center"><b>PRECIO</b></th>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>

						<div class="notices mb-3">
							<div>
								<h5><b>Condiciones Comerciales</b></h5>
							</div>
							<div class="notice advance_date"></div>
							<div class="notice advance_value"></div>
							<div class="notice policy"></div>
							<div class="notice"></div>
							<div class="notice"></div>

						</div>

						<div class="notices mb-3">
							<div>
								<h5><b>Información para la Entrega:</b></h5>
							</div>
							<div class="notice date_delivery">Fecha de Entrega: 10 dias habiles una vez recibida la orden de compra</div>
							<div class="notice address_delivery">Dirección de Entrega: Av americas # 71C -29</div>
							<div class="notice contact_delivery">Contacto: Ricardo Cubillos </div>
							<div class="notice city_delivery">Ciudad: Bogota D.C </div>
							<div class="notice phone_delivery">Teléfono: (601) 3586996 </div>
						</div>

					</main>
					<div class="mb-5 mt-5" style="margin-left: 30px;">
						<img class="signtureSeller" src="" alt="" style="width:20%"><br>
						<label style="font-size: large;"><b class="nameSeller"></b></label><br>
						<label style="font-size: large;" class="cellphoneSeller"></label><br>
						<label style="font-size: large;" class="emailSeller"></label><br>
						<label style="font-size: large;"><b>PROYECFORMAS LTDA</b></label><br>
					</div>
					<footer>Autorizo a Proyecformas Ltda. para recaudar, almacenar, utilizar y actualizar mis datos personales con fines exclusivamente comerciales y garantizándome que esta información no será revelada a terceros salvo orden de autoridad competente. Ley 1581 de 2012, Decreto 1377 de 2013.</footer>
				</div>
				<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
				<div></div>
			</div>
		</div>
	</div>
</div>

<script src="/app/js/orders/seeOrder.js"></script>