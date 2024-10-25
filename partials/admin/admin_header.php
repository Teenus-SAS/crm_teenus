<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
            </div>

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $_SESSION['avatar'] ?>" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0"><b><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname'];  ?></b></p>
                        <p class="designattion mb-0"><?php echo $_SESSION['position'] ?></p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="../app/views/login/reset-password.php"><i class="bx bx-happy"></i>
                            <span>Cambiar Foto</span></a>
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
</header>