<div class="page-breadcrumb noImprimir d-none d-sm-flex align-items-center mb-3">
	<?php
	session_start();
	if ($_SESSION['rol'] == 1) {  ?>
		<div class="breadcrumb-title noImprimir pe-3">Direción Comercial</div>
	<?php } ?>

	<?php if ($_SESSION['rol'] == 2) {  ?>
		<div class="breadcrumb-title noImprimir pe-3">Gestión Comercial</div>
	<?php } ?>
	<div class="ps-3 noImprimir">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Cotización</li>
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
					<button type="button" class="btn btn-warning" id="btnImprimirQuote"><i class="fa fa-print"></i>Imprimir</button>
					<!-- <button type="button" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> PDF</button>
					<button type="button" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Enviar</button> -->
				</div>
				<hr class="noImprimir" />
			</div>
			<div class="invoice printInvoice overflow-auto" id="printInvoice">
				<div style="min-width: 600px">
					<div>
						<div class="row">
							<div class="col">
								<a href="javascript:;">
									<img src="../app/assets/images/logo/logo-teenus.jpg" id="logo-teenus" width="50%" alt="" />
								</a>
							</div>
							<div class="col company-details">
								<!-- <h2 class="name">
									<a href="javascript:;" style="color: #8DAC18;">teenus</a>
								</h2> -->
								<div><b>KM 3.5 via Funza - Siberia. Parque industrial San José (Bodega 1B / Manzana C)</b></div>
								<div><b>NIT: 830074655-2</b></div>
							</div>
						</div>
					</div>

					<hr />

					<main>
						<div class="row contacts mb-3">
							<div class="col invoice-to">
								<div class="text-gray-light">Cotizado a:</div>
								<h3 class="company mb-0"></h3>
								<h6 class="nit mb-0"></h6>
								<h6 class="address mb-0"></h6>
								<h6 class="to"></h6>
								<h6 class="email"></h6>
							</div>
							<div class="col invoice-details mb-3">
								<h2 class="quote_id" style="color: #8DAC18;"></h2>
								<div class="dateCreation"></div>
								<div class="dateExpitation"></div>
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
									<th class="text-center"><b>VR. UNITARIO</b></th>
									<th class="text-center"><b>DESCUENTO</b></th>
									<th class="text-center"><b>VR. TOTAL</b></th>
								</tr>
							</thead>
							<tbody>


							</tbody>
							<tfoot>
								<tr>
									<td colspan="2"></td>
									<td colspan="4">SUBTOTAL</td>
									<td id="subtotal"></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td colspan="4">IVA 19%</td>
									<td id="iva"></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td colspan="4" style="color: #8DAC18;"><b>TOTAL</b></td>
									<td id="total" style="color: #8DAC18;"><b></b></td>
								</tr>
							</tfoot>
						</table>
						<div class=""></div>
						<div class="notices mb-3">
							<div class="notice mb-1"><b>Condiciones Comerciales:</b></div>
							<ul>
								<li>
									<div class="payment_conditions notice"></div>
								</li>
								<li>
									<div class="validity notice"></div>
								</li>
								<li>
									<div class="guarantee notice"></div>
								</li>
								<li>
									<div class="delivery_date notice"></div>
								</li>
							</ul>
						</div>
						<!-- <div class="notices mb-3">
							<div><b>Información para la Entrega:</b></div>
							<div class="notice">Fecha de Entrega: 10 dias habiles una vez recibida la orden de compra</div>
							<div class="notice">Dirección de Entrega: Av americas # 71C -29</div>
							<div class="notice">Contacto: Ricardo Cubillos </div>
							<div class="notice">Ciudad: Bogota D.C </div>
							<div class="notice">Teléfono: (601) 3586996 </div>
						</div> -->
						<div class="notices">
							<div class="notice mb-1"><b>Observaciones Generales para el Despacho:</b></div>
							<div class="notice">El cliente deberá contar con área y espacio listo para la instalación,
								ademas de confirmar datos exactos para la entrega:
								datos de contacto del responsable, dirección, horarios.<br><br>
								teenus Ltda. no asume arreglos, instalaciones eléctricas o de obra civil. </div>
						</div>
					</main>
					<div class="mb-5 mt-1" style="margin-left: 30px;">
						<img class="signature" src="" alt="" style="width:20%"><br>
						<label id="nameSeller" style="font-size: large;"><b></b></label><br>
						<label id="positionSeller" style="font-size: large;"><b></b></label><br>
						<label id="emailSeller" style="font-size: large;"><b></b></label><br>
						<label id="cellphoneSeller" style="font-size: large;"></label><br>
						<label style="font-size: large;">teenus LTDA</label>
					</div>
					<footer>Autorizo a teenus Ltda. para recaudar, almacenar, utilizar y actualizar mis datos personales con fines exclusivamente comerciales y garantizándome que esta información no será revelada a terceros salvo orden de autoridad competente. Ley 1581 de 2012, Decreto 1377 de 2013.</footer>
				</div>
				<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
				<div class="noImprimir"></div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="/app/js/quotes/seeQuote.js"></script>
<script src="/app/js/global/print.js"></script>