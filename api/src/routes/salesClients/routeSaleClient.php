<?php

use crmteenus\dao\GeneralSalesClientsDao;
use crmteenus\dao\SalesClientsDao;

$salesClientsDao = new SalesClientsDao();
$generalSalesClientsDao = new GeneralSalesClientsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/salesClients', function (Request $request, Response $response, $args) use (
    $salesClientsDao
) {
    $clients = $salesClientsDao->findAllSalesClients();
    $response->getBody()->write(json_encode($clients));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addSaleClient', function (Request $request, Response $response, $args) use (
    $salesClientsDao,
    $generalSalesClientsDao
) {
    $dataClient = $request->getParsedBody();

    $client = $generalSalesClientsDao->findSaleClient($dataClient);

    if (!$client) {
        $resolution = $salesClientsDao->addSaleClient($dataClient);

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Cliente creado correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    } else
        $resp = ['info' => true, 'message' => 'El email ya se encuentra registrado. Intente con uno nuevo'];

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->post('/updateSaleClient', function (Request $request, Response $response, $args) use (
    $salesClientsDao,
    $generalSalesClientsDao
) {
    $dataClient = $request->getParsedBody();

    $client = $generalSalesClientsDao->findSaleClient($dataClient);

    !is_array($client) ? $data['id_sale_client'] = 0 : $data = $client;
    if ($data['id_sale_client'] == $client['idSaleClient'] || $data['id_sale_client'] == 0) {
        $resolution = $salesClientsDao->updateSaleClient($dataClient);

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Cliente modificado correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    } else
        $resp = ['info' => true, 'message' => 'El email ya se encuentra registrado. Intente con uno nuevo'];

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->get('/deleteSaleClient/{id_sale_client}', function (Request $request, Response $response, $args) use ($salesClientsDao) {
    $resolution = $salesClientsDao->deleteSaleClient($args['id_sale_client']);

    if ($resolution == null)
        $resp = ['success' => true, 'message' => 'Cliente eliminado correctamente'];
    else if (isset($resolution['info']))
        $resp = ['info' => true, 'message' => $resolution['message']];
    else
        $resp = ['error' => true, 'message' => 'Ocurrio un error al eliminar la información. Intente nuevamente'];

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
