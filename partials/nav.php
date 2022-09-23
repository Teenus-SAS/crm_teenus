<div class="nav-container">
    <div class="mobile-topbar-header">
        <div>
            <img src="/app/assets/images/icons/icono_teenus.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Teenus</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <?php if ($_SESSION['rol'] != 3) { ?>
        <nav class="topbar-nav">
            <ul class="metismenu" id="menu">
                <li>
                    <!-- <a href="javascript:;" id="navBudget" onclick="cargarContenido('page-content','views/commercial/budget.php')"> -->
                    <a href="/budget" id="navBudget">
                        <div class="parent-icon"><i class="bx bx-notepad"></i></div>
                        <div class="menu-title">Presupuesto</div>
                    </a>
                </li>
                <li>
                    <!-- <a href="javascript:;" onclick="cargarContenido('page-content','views/commercial/dashboard.php')"> -->
                    <a href="/dashboard">
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
                        <!-- <li> <a href="javascript:;" id="navContacts" onclick="cargarContenido('page-content','views/commercial/contacts.php')"><i class="bx bx-group"></i>Contactos</a></li> -->
                        <!-- <li> <a href="javascript:;" id="navCompanies" onclick="cargarContenido('page-content','views/commercial/companies.php')"><i class="bx bx-buildings"></i>Empresas</a></li> -->
                        <li> <a href="/contacts" id="navContacts"><i class="bx bx-group"></i>Contactos</a></li>
                        <li> <a href="/companies" id="navCompanies"><i class="bx bx-buildings"></i>Empresas</a></li>
                    </ul>
                </li>
                <li>
                    <!-- <a href="javascript:;" id="navBusiness" onclick="cargarContenido('page-content','views/commercial/business.php')"> -->
                    <a href="/projects" id="navBusiness">
                        <div class="parent-icon"><i class="bx bx-expand"></i></div>
                        <div class="menu-title">Proyectos</div>
                    </a>
                </li>

                <li>
                    <!-- <a href="javascript:;" id="navSchedule" onclick="cargarContenido('page-content','views/commercial/schedule.php')"> -->
                    <a href="/schedule" id="navSchedule">
                        <div class="parent-icon"><i class="bx bx-task"></i></div>
                        <div class="menu-title">Agenda</div>
                    </a>
                </li>
                <li>
                    <!-- <a href="javascript:;" id="navQuotes" onclick="cargarContenido('page-content','views/commercial/quotes.php')"> -->
                    <a href="/quotes" id="navQuotes">
                        <div class="parent-icon"><i class="bx bx-transfer"></i></div>
                        <div class="menu-title">Cotizaciones</div>
                    </a>
                </li>

                <li>
                    <a href="/billings" id="navBilling">
                        <div class="parent-icon"><i class="bx bx-box"></i></div>
                        <div class="menu-title">Facturación</div>
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
                        <div class="parent-icon"><i class="bx bx-box"></i></div>
                        <div class="menu-title">Pedidos</div>
                    </a>
                </li>
            </ul>
        </nav>
    <?php } ?>
</div>