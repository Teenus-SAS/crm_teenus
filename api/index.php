<?php


use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

$app = AppFactory::create();
$app->setBasePath('/api');

/* Routes */

/* Proceso Comercial */

require_once('../api/src/routes/commercialProcess/routeBusiness.php');
require_once('../api/src/routes/commercialProcess/routeSchedules.php');
require_once('../api/src/routes/commercialProcess/routeQuotes.php');
require_once('../api/src/routes/commercialProcess/routeOrders.php');

/* Empresas */

require_once('../api/src/routes/companies/routeContacts.php');
require_once('../api/src/routes/companies/routeCompanies.php');

/* Configuracion */

require_once('../api/src/routes/configuration/routeContactForms.php');
require_once('../api/src/routes/configuration/routePaymentMethods.php');
require_once('../api/src/routes/configuration/routePhases.php');
require_once('../api/src/routes/configuration/routeSalesChannels.php');
require_once('../api/src/routes/configuration/routeBudgets.php');
require_once('../api/src/routes/configuration/routeCategories.php');
require_once('../api/src/routes/configuration/routeZones.php');

/* Dashboard */

require_once('../api/src/routes/dashboard/routeDashboard.php');

/* Remissiones */

require_once('../api/src/routes/remissionsProcess/routeRemissions.php');

/* Usuarios */

require_once('../api/src/routes/users/routeUsers.php');
require_once('../api/src/routes/users/routeRols.php');






$app->run();
