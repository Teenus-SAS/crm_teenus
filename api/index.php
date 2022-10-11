<?php


use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

$app = AppFactory::create();
$app->setBasePath('/api');

/* Routes */

/* Proceso Comercial */

require_once('/api/src/routes/commercialProcess/routeBusiness.php');
require_once('/api/src/routes/commercialProcess/routeOrders.php');
require_once('/api/src/routes/commercialProcess/routeQuotes.php');
require_once('/api/src/routes/commercialProcess/routeSchedules.php');

/* Empresas */

require_once('/api/src/routes/companies/routeCompanies.php');
require_once('/api/src/routes/companies/routeContacts.php');

/* Configuracion */

require_once('/api/src/routes/configuration/routeBudgets.php');
require_once('/api/src/routes/configuration/routeCategories.php');
require_once('/api/src/routes/configuration/routeContactForms.php');
require_once('/api/src/routes/configuration/routePaymentMethods.php');
require_once('/api/src/routes/configuration/routePhases.php');
require_once('/api/src/routes/configuration/routeSalesChannels.php');
require_once('/api/src/routes/configuration/routeSubcategories.php');
require_once('/api/src/routes/configuration/routeZones.php');

/* Dashboard */

require_once('/api/src/routes/dashboard/routeDashboard.php');

/* Remissiones */

require_once('/api/src/routes/remissionsProcess/routeRemissions.php');

/* Usuarios */

require_once('/api/src/routes/users/routeLogin.php');
require_once('/api/src/routes/users/routePasswordUsers.php');
require_once('/api/src/routes/users/routeRols.php');
require_once('/api/src/routes/users/routeStatusUsers.php');
require_once('/api/src/routes/users/routeUsers.php');


$app->run();
