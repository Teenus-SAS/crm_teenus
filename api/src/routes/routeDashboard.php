<?php

use crmproyecformas\dao\DashboardDao;

$dashboardDao = new DashboardDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Configuracion de indicadores */

$app->get('/indicators/{id}', function (Request $request, Response $response, $args) use ($dashboardDao) {
    $dashboardCustomers = $dashboardDao->findNewCustomers($args['id']);
    $dashboardBusiness = $dashboardDao->findNewBusiness($args['id']);
    $dashboardPriceBusiness = $dashboardDao->findTotalPriceBusiness($args['id']);
    $dashboardPriceOrders = $dashboardDao->findTotalPriceOrders($args['id']);

    $indicators = [];

    array_push($indicators, $dashboardCustomers[0]);
    array_push($indicators, $dashboardBusiness[0]);
    array_push($indicators, $dashboardPriceBusiness[0]);
    array_push($indicators, $dashboardPriceOrders[0]);

    $response->getBody()->write(json_encode($indicators, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/budgetsvsOrders/{id}', function (Request $request, Response $response, $args) use ($dashboardDao) {
    $dashboardBudgetsvsOrders = $dashboardDao->findBudgetsvsOrders($args['id']);

    $response->getBody()->write(json_encode($dashboardBudgetsvsOrders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/quantityCustomers/{id}', function (Request $request, Response $response, $args) use ($dashboardDao) {
    $dashboardquantityCustomers = $dashboardDao->findQuantityCustomers($args['id']);

    $response->getBody()->write(json_encode($dashboardquantityCustomers, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/quantityBusiness/{id}', function (Request $request, Response $response, $args) use ($dashboardDao) {
    $dashboardquantitybusiness = $dashboardDao->findQuantityBusiness($args['id']);

    $response->getBody()->write(json_encode($dashboardquantitybusiness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/valuedBusiness/{id}', function (Request $request, Response $response, $args) use ($dashboardDao) {
    $valuedBusiness = $dashboardDao->findValuedBusiness($args['id']);

    $response->getBody()->write(json_encode($valuedBusiness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/valuedOrders/{id}', function (Request $request, Response $response, $args) use ($dashboardDao) {
    $valuedOrders = $dashboardDao->findValuedOrders($args['id']);

    $response->getBody()->write(json_encode($valuedOrders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
