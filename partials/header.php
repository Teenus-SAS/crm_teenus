<?php include_once dirname(__DIR__) . '/modals/modalModifyProfileUser.php'; ?>

<div class="topbar d-flex align-items-center">
	<nav class="navbar navbar-expand">
		<div class="topbar-logo-header">
			<div class="">
				<img src="/app/assets/images/logo/logo-teenus.png" class="logo-icon" style="width: 35%;" alt="logo icon">
			</div>
		</div>
		<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
		<div class="search-bar flex-grow-1">
		</div>
		<div class="top-menu ms-auto">
			<ul class="navbar-nav align-items-center">
				<li class="nav-item mobile-search-icon">
					<a class="nav-link" href="javascript:;"> <i class='bx bx-search'></i>
					</a>
				</li>
				<li class="nav-item dropdown dropdown-large">

				</li>
				<?php if ($_SESSION['rol'] == 1) {  ?>
					<li class="nav-item dropdown dropdown-large">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class='lni lni-cog' style="color: seagreen;"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="#">
								<div class="msg-header">
									<p class="msg-header-title">Configuración General</p>
								</div>
							</a>
							<div class="header-notifications-list">
								<a class="dropdown-item" href="/paymentMethods">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-primary text-primary"><i class="bx bx-money"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configMethodPayment">Métodos de Pago</h6>
										</div>
									</div>
								</a>
								<a class="dropdown-item" href="/contactForms">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-danger text-danger"><i class="bx bx-phone"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configContactForms">Formas de Contacto </h6>
										</div>
									</div>
								</a>

								<a class="dropdown-item" href="/salesPhases">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-success text-success"><i class="bx bx-stats"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configSalesPhases">Fases de Venta</h6>
										</div>
									</div>
								</a>

								<a class="dropdown-item" href="/salesChannels">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-warning text-warning"><i class="bx bx-transfer"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configSalesChannels">Canales de Venta</h6>

										</div>
									</div>
								</a>
								<a class="dropdown-item" href="/categories">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-info text-info"><i class="lni lni-users"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configcategoriesClients">Categoria de Clientes</h6>

										</div>
									</div>
								</a>
								<a class="dropdown-item" href="/saleClients">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-danger text-danger"><i class="lni lni-map"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configSalesClients">Ventas Clientes</h6>
										</div>
									</div>
								</a>
								<a class="dropdown-item" href="/sellers">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-success text-success"><i class="bx bx-network-chart"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="configZones">Asesores Comerciales</h6>

										</div>
									</div>
								</a>
							</div>
						</div>
					</li>
				<?php }  ?>
			</ul>
		</div>
		<div class="user-box dropdown">
			<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<img src="<?php echo $_SESSION['avatar'] ?>" class="user-img" alt="user avatar">
				<div class="user-info ps-3">
					<p class="user-name mb-0"><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname'];  ?></p>
					<p class="designattion mb-0"><?php echo $_SESSION['position'] ?></p>
				</div>
			</a>
			<ul class="dropdown-menu dropdown-menu-end">
				<li><a class="dropdown-item profile" href="javascript:;"><i class="bx bxs-face"></i>
						<span>Modificar Datos de Perfil</span></a>
				</li>
				<li><a class="dropdown-item" href="../app/views/login/reset-password.php"><i class="bx bx-key"></i>
						<span>Cambiar Contraseña</span></a>
				</li>
				<li>
					<a class="dropdown-item" href="#" id="btnLogout">
						<i class='bx bx-log-out-circle' id="btnLogout"></i>
						<span>Salir</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</div>