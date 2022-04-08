<?php

use crmteenus\dao\BudgetsDao;

$budgetDao = new BudgetsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/budgets', function (Request $request, Response $response, $args) use ($budgetDao) {
    $budgets = $budgetDao->findAll();
    $response->getBody()->write(json_encode($budgets, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consulta uno */

$app->get('/budgetUser', function (Request $request, Response $response, $args) use ($budgetDao) {
    $budgets = $budgetDao->findOne();
    $response->getBody()->write(json_encode($budgets, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addBudget', function (Request $request, Response $response, $args) use ($budgetDao) {
    $dataBudget = $request->getParsedBody();

    foreach ($dataBudget as $budget) {
        if (empty($budget)) {
            $resp = array('error' => true, 'message' => 'Datos incompletos, intente nuevamente');
            $response->getBody()->write(json_encode($resp));
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        }
    }

    $budgets = $budgetDao->saveBudget($dataBudget);

    if ($budgets == 1) {
        $resp = array('success' => true, 'message' => 'Presupuesto creado correctamente');
    }
    if ($budgets == 2) {
        $resp = array('success' => true, 'message' => 'Presupuesto actualizado correctamente');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->post('/deleteBudget', function (Request $request, Response $response, $args) use ($budgetDao) {
    $dataCompanie = $request->getParsedBody();
    $companies = $budgetDao->deleteBudget($dataCompanie);
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
