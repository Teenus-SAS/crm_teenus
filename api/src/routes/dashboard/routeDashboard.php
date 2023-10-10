<?php

use crmteenus\dao\BillingsKeyDao;
use crmteenus\dao\BusinessKeyDao;
use crmteenus\dao\CustomersDao;
use crmteenus\dao\OrdersKeyDao;
use crmteenus\dao\SalesDao;

$businesskeyDao = new BusinessKeyDao();
$customersDao = new CustomersDao();
$orderskeyDao = new OrdersKeyDao();
$billingsKeyDao = new BillingsKeyDao();
$salesDao = new SalesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Configuracion de indicadores */

$app->get('/indicators/{id}', function (Request $request, Response $response, $args) use ($businesskeyDao, $customersDao, $billingsKeyDao, $salesDao) {
    $customers = $customersDao->findNewCustomers($args['id']);
    $business = $businesskeyDao->findNewBusiness($args['id']);
    $priceBusiness = $businesskeyDao->findTotalPriceBusiness($args['id']);
    $priceBillings = $billingsKeyDao->findTotalPriceBillings($args['id']);
    $sales = $salesDao->findActualValuedSales();
    // $priceOrders = $orderskeyDao->findTotalPriceOrders($args['id']);

    $indicators = [];

    array_push($indicators, $customers[0]);
    array_push($indicators, $business[0]);
    array_push($indicators, $priceBusiness[0]);
    array_push($indicators, $priceBillings[0]);
    array_push($indicators, $sales[0]);
    // array_push($indicators, $priceOrders[0]);

    $response->getBody()->write(json_encode($indicators, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/budgetsvsOrders/{id}', function (Request $request, Response $response, $args) use ($orderskeyDao) {
    $businessBudgetsvsOrders = $orderskeyDao->findBudgetsvsBill($args['id']);

    $response->getBody()->write(json_encode($businessBudgetsvsOrders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/quantityCustomers/{id}', function (Request $request, Response $response, $args) use ($customersDao) {
    $businessquantityCustomers = $customersDao->findQuantityCustomers($args['id']);

    $response->getBody()->write(json_encode($businessquantityCustomers, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/newBusiness/{id}', function (Request $request, Response $response, $args) use ($businesskeyDao) {
    $businessquantity = $businesskeyDao->findQuantityNewBusiness($args['id']);

    $response->getBody()->write(json_encode($businessquantity, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/quantityBusiness/{id}', function (Request $request, Response $response, $args) use ($businesskeyDao) {
    $businessquantitybusiness = $businesskeyDao->findQuantityBusiness($args['id']);

    $response->getBody()->write(json_encode($businessquantitybusiness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/valuedBusiness/{id}', function (Request $request, Response $response, $args) use ($businesskeyDao) {
    $valuedBusiness = $businesskeyDao->findValuedBusiness($args['id']);

    $response->getBody()->write(json_encode($valuedBusiness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/valuedOrders/{id}', function (Request $request, Response $response, $args) use ($orderskeyDao) {
    $valuedOrders = $orderskeyDao->findValuedBill($args['id']);

    $response->getBody()->write(json_encode($valuedOrders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
