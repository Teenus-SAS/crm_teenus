<div class="nav-container">
    <div class="mobile-topbar-header">
        <div>
            <img src="../../../app/assets/images/icons/icon.jpg" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">teenus</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <?php if ($_SESSION['rol'] != 3) { ?>
        <nav class="topbar-nav">
            <ul class="metismenu" id="menu">
                <li>
                    <a href="javascript:;" onclick="cargarContenido('page-content','views/commercial/dashboard.php')">
                        <div class="parent-icon"><i class='bx bx-line-chart bx-burst-hover'></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li id="menuContactLi">
                    <a href="javascript:;" id="menuContacts" class="has-arrow menuContacts">
                        <div class="parent-icon"><i class="bx bx-group"></i>
                        </div>
                        <div class="menu-title">Contactos</div>
                    </a>
                    <ul id="menuContactLu">
                        <li> <a href="javascript:;" id="navContacts" onclick="cargarContenido('page-content','views/commercial/contacts.php')"><i class="bx bx-group"></i>Contactos</a></li>
                        <li> <a href="javascript:;" id="navCompanies" onclick="cargarContenido('page-content','views/commercial/companies.php')"><i class="bx bx-buildings"></i>Empresas</a></li>
                        <?php //if ($_SESSION['rol'] == 1) {   
                        ?>
                        <!-- <li> <a href="javascript:;" id="navZonesAssigned" onclick="cargarContenido('page-content','views/commercial/zonesAssigned.php')"><i class="lni lni-map"></i>Zonas</a></li> -->
                        <?php //}  
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" id="navBusiness" onclick="cargarContenido('page-content','views/commercial/business.php')">
                        <div class="parent-icon"><i class="bx bx-expand"></i>
                        </div>
                        <div class="menu-title">Proyectos</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="navBudget" onclick="cargarContenido('page-content','views/commercial/budget.php')">
                        <div class="parent-icon"><i class="bx bx-notepad"></i></div>
                        <div class="menu-title">Presupuesto</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="navSchedule" onclick="cargarContenido('page-content','views/commercial/schedule.php')">
                        <div class="parent-icon"><i class="bx bx-task"></i>
                        </div>
                        <div class="menu-title">Agenda</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="navQuotes" onclick="cargarContenido('page-content','views/commercial/quotes.php')">
                        <div class="parent-icon"><i class="bx bx-transfer"></i>
                        </div>
                        <div class="menu-title">Cotizaciones</div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" id="navPedidos" onclick="cargarContenido('page-content','views/commercial/orders.php')">
                        <div class="parent-icon"><i class="bx bx-box"></i>
                        </div>
                        <div class="menu-title">Pedidos</div>
                    </a>
                </li>

            </ul>
        </nav>
    <?php } ?>
    <?php if ($_SESSION['rol'] == 3) { ?>
        <nav class="topbar-nav">
            <ul class="metismenu" id="menu">
                <li>
                    <a href="javascript:;" id="navPedidos" onclick="cargarContenido('page-content','views/commercial/orders.php')">
                        <div class="parent-icon"><i class="bx bx-box"></i>
                        </div>
                        <div class="menu-title">Pedidos</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="navPedidos" onclick="cargarContenido('page-content','views/remissions/remissions.php')">
                        <div class="parent-icon"><i class="bx bxs-truck"></i>
                        </div>
                        <div class="menu-title">Remisiones</div>
                    </a>
                </li>

            </ul>
        </nav>
    <?php } ?>
</div>