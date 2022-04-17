<?php
session_start();
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 ">

	<div class="breadcrumb-title pe-3 noImprimir">Gestión Administrativa</div>

	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Remisión</li>
			</ol>
		</nav>
	</div>
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
									<img src="../app/assets/images/logo/logo-teenus.jpg" id="logo-teenus" width="50%" alt="" />
								</a>
							</div>
							<div class="col company-details">
								<div><b>KM 3.5 via Funza - Siberia. Parque industrial San José (Bodega 1B / Manzana C)</b></div>
								<div><b>NIT: 830074655-2</b></div>
							</div>
						</div>
					</div>

					<hr />

					<main style="padding-bottom: 0px;">
						<div class="row contacts">
							<div class="col invoice-to">
								<div class="text-gray-light">Señores</div>
								<h3 class="company mb-0"></h3>
								<h6 class="nit mb-0"></h6>
								<h6 class="address mb-0"></h6>
								<h6 class="to"></h6>
								<h6 class="email"></h6>
							</div>
							<div class="col invoice-details">
								<h2 class="remission_id" style="color: #8DAC18;"></h2>
								<h2 class="order_id" style="color: #8DAC18;"></h2>
								<div class="dateCreation"></div>
								<div class="purchaseOrder"></div>
							</div>
						</div>
						<hr>
						<h3 class="business">PROYECTO:</h3>
						<hr>
						<div class="alert alert-primary mb-3" role="alert">
							Hacemos entrega de los siguientes artículos
						</div>

						<table id="tableProductsRemission">
							<thead>
								<tr>
									<th class="text-center"><b>REFERENCIA</b></th>
									<th class="text-center"><b>DESCRIPCIÓN</b></th>
									<th class="text-center"><b>CANTIDAD ENTREGADA</b></th>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>
						<div class=""></div>
					</main>

					<div class="alert alert-warning" role="alert">
						<h5><b>Información para la Entrega:</b></h5>
						<div class="notice date_delivery"></div>
						<div class="notice address_delivery"></div>
						<div class="notice contact_delivery"></div>
						<div class="notice city_delivery"></div>
						<div class="notice phone_delivery"></div>
						<div class="notice observations"></div>
					</div>

					<div>
						Cordialmente,
					</div>
					<div style="display:grid;grid-template-columns:1fr 1fr">
						<div class="mb-5 mt-5" style="margin-left: 30px;">
							<img class="signtureAux" src="" alt="" style="width:40%"><br>
							<label style="font-size: large;"><b class="nameAux"></b></label><br>
							<label style="font-size: large;"><b class="positionAux"></b></label><br>
							<label style="font-size: large;" class="emailAux"></label><br>
							<label style="font-size: large;" class="cellphoneAux"></label><br>
							<label style="font-size: large;"><b>teenus LTDA</b></label><br>
						</div>

						<div style="margin-left: 30px;margin-top: 160px;">
							<label>_____________________________________</label><br>
							<label style="font-size: large;"><b>Nombre Legible y Firma</b></label><br>
							<label style="font-size: large;"><b>C.C</b></label><br>
							<label style="font-size: large;"><b>Sello</b></label><br>
						</div>
					</div>
					<footer>Autorizo a teenus Ltda. para recaudar, almacenar, utilizar y actualizar mis datos personales con fines exclusivamente comerciales y garantizándome que esta información no será revelada a terceros salvo orden de autoridad competente. Ley 1581 de 2012, Decreto 1377 de 2013.</footer>
				</div>
				<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
				<div></div>
			</div>
		</div>
	</div>
</div>

<script src="/app/js/remissions/seeRemission.js"></script>