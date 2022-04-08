<?php


use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

$app = AppFactory::create();
$app->setBasePath('/api');

/* $app->get('/', function (Request $request, Response $response, $args) {
  $response->getBody()->write("Hello world!");
  return $response;
}); */
require_once('../api/src/routes/routeContacts.php');
require_once('../api/src/routes/routeCompanies.php');
require_once('../api/src/routes/routeContactForms.php');
require_once('../api/src/routes/routePaymentMethods.php');
require_once('../api/src/routes/routePhases.php');
require_once('../api/src/routes/routeSalesChannels.php');
require_once('../api/src/routes/routeBudgets.php');
require_once('../api/src/routes/routeCategories.php');
require_once('../api/src/routes/routeZones.php');

require_once('../api/src/routes/routeUsers.php');
require_once('../api/src/routes/routeRols.php');

require_once('../api/src/routes/routeBusiness.php');
require_once('../api/src/routes/routeSchedules.php');

require_once('../api/src/routes/routeQuotes.php');
require_once('../api/src/routes/routeOrders.php');
require_once('../api/src/routes/routeRemissions.php');

require_once('../api/src/routes/routeDashboard.php');

$app->run();
