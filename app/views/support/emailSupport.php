<?php
if (!isset($_SESSION)) {
    session_start();
    if (sizeof($_SESSION) == 0)
        header('location: /');
}
if (sizeof($_SESSION) == 0)
    header('location: /');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once dirname(dirname(dirname(__DIR__))) .  '/partials/scripts_header.php'; ?>
</head>

<body class="horizontal-navbar">
    <!-- Begin Page -->
    <div class="page-wrapper">
        <!--start header -->
        <header>
            <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/header.php'; ?>
        </header>

        <!--navigation-->
        <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/nav.php'; ?>

        <!-- Begin main content -->
        <div class="main-content">
            <!-- Loader -->
            <div class="loading">
                <a href="javascript:;" class="close-btn" style="display: none;"><i class="bi bi-x-circle-fill"></i></a>
                <div class="loader"></div>
            </div>

            <!-- Content -->
            <div class="page-content">
                <!-- Page header -->
                <div class="page-title-box">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-5 col-xl-6">
                                <div class="page-title">
                                    <h3 class="mb-1 font-weight-bold text-dark">Soporte</h3>
                                    <ol class="breadcrumb mb-3 mb-md-0">
                                        <li class="breadcrumb-item active">Escribanos, que estaremos muy atentos de atender sus requerimientos</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-xl-6 form-inline justify-content-sm-end">
                                <div class="col-xs-4 mr-2">
                                    <button type="button" class="btn btn-primary" id="btnSimSend">Email Prueba</button>
                                </div>
                                <div class="col-xs-4 py-2 mr-2">
                                    <button type="button" class="btn btn-secondary" id="btnSend">Enviar a Todos</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-content-wrapper mt--45">
                    <div class="container-fluid">
                        <div class="row align-items-stretch">
                            <div class="col-md-8 col-lg-12">
                                <div class="inbox-rightbar card">
                                    <div class="card-body">
                                        <form id="formSendSupport">
                                            <!-- Para field -->
                                            <div class="form-group cardTo">
                                                <label for="to">Para</label>
                                                <input type="email" class="form-control" id="to" placeholder="Para" />
                                            </div>

                                            <!-- CC field -->
                                            <div class="form-group">
                                                <label for="ccHeader">CC</label>
                                                <input type="email" class="form-control" placeholder="CC" id="ccHeader" name="ccHeader" />
                                            </div>

                                            <!-- Asunto field -->
                                            <div class="form-group">
                                                <label for="subject">Asunto</label>
                                                <input type="text" class="form-control" placeholder="Asunto" id="subject" name="subject" />
                                            </div>

                                            <!-- Message field -->
                                            <div class="form-group mb-2">
                                                <label for="compose-editor">Mensaje</label>
                                                <div class="form-control" contenteditable="true" id="compose-editor" name="message">Hey</div>
                                            </div>

                                            <!-- Buttons -->
                                            <!-- <div class="form-group text-right">
                                                <button type="button" class="btn btn-primary chat-send-btn" data-effect="wave" id="btnSend">
                                                    <span class="d-none d-sm-inline-block mr-2 align-middle">Enviar</span>
                                                    <i class="bx bxs-send fs-sm align-middle"></i>
                                                </button>
                                                <button type="button" class="btn btn-secondary chat-send-btn ml-2" data-effect="wave" id="btnSimSend">
                                                    <span class="d-none d-sm-inline-block mr-2 align-middle">Prueba</span>
                                                    <i class="bx bxs-send fs-sm align-middle"></i>
                                                </button>
                                            </div> -->
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content end -->

        <!-- Footer -->
        <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/footer.php'; ?>
    </div>
    <!-- Page End -->
    <!--switcher-->
    <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/darkmode.php' ?>

    <!-- scripts -->
    <?php include_once dirname(dirname(dirname(__DIR__))) . '/partials/scripts_js.php' ?>

    <script src="/app/js/support/support.js"></script>
</body>

</html>