<?php

use crmteenus\dao\BusinessDao;
use crmteenus\dao\CustomersDao;
use crmteenus\dao\OrdersDao;

$businessDao = new BusinessDao();
$customersDao = new CustomersDao();
$ordersDao = new OrdersDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Configuracion de indicadores */

$app->get('/indicators/{id}', function (Request $request, Response $response, $args) use ($businessDao, $customersDao, $ordersDao) {
    $customers = $customersDao->findNewCustomers($args['id']);
    $business = $businessDao->findNewBusiness($args['id']);
    $priceBusiness = $businessDao->findTotalPriceBusiness($args['id']);
    $priceOrders = $ordersDao->findTotalPriceOrders($args['id']);

    $indicators = [];

    array_push($indicators, $customers[0]);
    array_push($indicators, $business[0]);
    array_push($indicators, $priceBusiness[0]);
    array_push($indicators, $priceOrders[0]);

    $response->getBody()->write(json_encode($indicators, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/budgetsvsOrders/{id}', function (Request $request, Response $response, $args) use ($ordersDao) {
    $businessBudgetsvsOrders = $ordersDao->findBudgetsvsOrders($args['id']);

    $response->getBody()->write(json_encode($businessBudgetsvsOrders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/quantityCustomers/{id}', function (Request $request, Response $response, $args) use ($customersDao) {
    $businessquantityCustomers = $customersDao->findQuantityCustomers($args['id']);

    $response->getBody()->write(json_encode($businessquantityCustomers, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/quantityBusiness/{id}', function (Request $request, Response $response, $args) use ($businessDao) {
    $businessquantitybusiness = $businessDao->findQuantityBusiness($args['id']);

    $response->getBody()->write(json_encode($businessquantitybusiness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/valuedBusiness/{id}', function (Request $request, Response $response, $args) use ($businessDao) {
    $valuedBusiness = $businessDao->findValuedBusiness($args['id']);

    $response->getBody()->write(json_encode($valuedBusiness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/valuedOrders/{id}', function (Request $request, Response $response, $args) use ($ordersDao) {
    $valuedOrders = $ordersDao->findValuedOrders($args['id']);

    $response->getBody()->write(json_encode($valuedOrders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
