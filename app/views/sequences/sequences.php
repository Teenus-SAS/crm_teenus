<?php
require_once dirname(dirname(__DIR__)) . '/sesiones/sesion_com.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php'; ?>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start header -->
        <header>
            <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php'; ?>
        </header>

        <!--navigation-->
        <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>

        <!--page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!-- page header -->
                <div class="page-title-box">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-5 col-xl-8">
                                <div class="page-title">
                                    <h3 class="mb-1 font-weight-bold text-dark"><i class="fas fa-cogs mr-1"></i>Secuencias</h3>
                                    <ol class="breadcrumb mb-3 mb-md-0">
                                        <li class="breadcrumb-item active">Creación de Secuencias</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-sm-7 col-xl-4 btn-group form-inline justify-content-sm-end">
                                <div class="col-xs-2" style="margin-right: 10px;">
                                    <button type="button" class="btn btn-primary" id="btnNewSequences">Crear Nueva Secuencia</button>
                                </div>
                                <!-- <div class="col-xs-2">
                                    <button type="button" class="btn btn-secondary" id="btnNewImportsequences">Importar Clientes</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- -->
                <div class="page-content-wrapper mt--45 mb-5 cardCreateSequence">
                    <div class="container-fluid">
                        <form class="col-12" id="formAddSequence">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-10 floating-label enable-floating-label show-label">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" name="nameSequence" id="sequence">
                                        </div>
                                        <div class="col-sm mt-3">
                                            <button class="btn btn-success" id="btnAddSequence">Crear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <hr />

                <div class="page-content-wrapper mt--45 mb-5">
                    <div class="container-fluid">
                        <!-- <div class="row">
                            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active selectNavigation" id="link-clients" data-toggle="pill" href="javascript:;" role="tab" aria-controls="pills-projects" aria-selected="false">
                                        <i class="bi bi-diagram-3 mr-1"></i>Clientes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link selectNavigation" id="link-groups" data-toggle="pill" href="javascript:;" role="tab" aria-controls="pills-activity" aria-selected="true">
                                        <i class="fas fa-cogs mr-1"></i>Grupos
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                        <div class="row">
                            <div class="card">
                                <div class="tab-pane">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="fixed-table-loading table table-hover" id="tableSequences"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--overlay-->
    <div class="overlay toggle-icon"></div>

    <!--Back To Top Button-->
    <a href="javaScript:;" class="back-to-top noImprimir"><i class='bx bxs-up-arrow-alt'></i></a>

    <!-- footer -->
    <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>
    </div>

    <!--switcher-->
    <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php' ?>

    <!-- scripts -->
    <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php' ?>

    <script src="/app/js/sequences/tblSequences.js"></script>
    <script src="/app/js/sequences/sequences.js"></script>
</body>

</html>