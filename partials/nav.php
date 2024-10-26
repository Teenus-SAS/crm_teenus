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
                        <li> <a href="/contacts" id="navContacts"><i class="bx bx-group"></i>Contactos</a></li>
                        <li> <a href="/companies" id="navCompanies"><i class="bx bx-buildings"></i>Empresas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/projects" id="navBusiness">
                        <div class="parent-icon"><i class="bx bx-expand"></i></div>
                        <div class="menu-title">Proyectos</div>
                    </a>
                </li>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <a href="/budget" id="navBudget">
                            <div class="parent-icon"><i class="bx bx-notepad"></i></div>
                            <div class="menu-title">Presupuesto</div>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="/schedule" id="navSchedule">
                        <div class="parent-icon"><i class="bx bx-task"></i></div>
                        <div class="menu-title">Agenda</div>
                    </a>
                </li>

                <li>
                    <a href="/billings" id="navBilling">
                        <div class="parent-icon"><i class="bx bx-box"></i></div>
                        <div class="menu-title">Facturación</div>
                    </a>
                </li>
                <li>
                    <a href="/support" id="navSupport">
                        <div class="parent-icon"><i class="bx bx-box"></i></div>
                        <div class="menu-title">Email Marketing</div>
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