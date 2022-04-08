<?php

use crmproyecformas\dao\QuotesDao;

$quotesDao = new QuotesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/quotes', function (Request $request, Response $response, $args) use ($quotesDao) {
    $zones = $quotesDao->findAll();
    $response->getBody()->write(json_encode($zones, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Forma de Contacto */
$app->post('/addQuotes', function (Request $request, Response $response, $args) use ($quotesDao) {
    $dataquote = $request->getParsedBody();

    if (empty($dataquote['company']) || empty($dataquote['contact']) || empty($dataquote['products']) || empty($dataquote['business'])) {
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos');
    } else {

        $respquote = $quotesDao->saveQuote($dataquote);
        if ($respquote == 2)
            $resp = array('success' => true, 'message' => 'Cotización actualizada correctamente');

        if ($respquote == 1)
            $resp = array('success' => true, 'message' => 'Cotización creada correctamente');

        if ($respquote == 3)
            $resp = array('error' => true, 'message' => 'La Cotización no puede ser actualizada, Pedido ya creado');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Actualizar Cotización */
$app->get('/updateQuotes/{id}', function (Request $request, Response $response, $args) use ($quotesDao) {
    $dataquote = $quotesDao->findQuoteById($args['id']);
    $response->getBody()->write(json_encode($dataquote, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


/* Eliminar Forma de Contacto */
$app->post('/deleteQuotes', function (Request $request, Response $response, $args) use ($quotesDao) {
    $dataCompanie = $request->getParsedBody();
    $companies = $quotesDao->deleteQuote($dataCompanie);
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Condiciones Comerciales */
$app->get('/conditionsQuotes', function (Request $request, Response $response, $args) use ($quotesDao) {
    $conditionsquote = $quotesDao->findConditions();
    $response->getBody()->write(json_encode($conditionsquote, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
