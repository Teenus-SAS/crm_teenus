<?php

use crmteenus\dao\GeneralSalesClientsDao;
use crmteenus\dao\GroupsDao;
use crmteenus\dao\SalesClientsDao;

$salesClientsDao = new SalesClientsDao();
$generalSalesClientsDao = new GeneralSalesClientsDao();
$groupsDao = new GroupsDao();

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

// checkear data importe
$app->post('/salesClientsDataValidation', function (Request $request, Response $response, $args) use (
    $groupsDao,
    $generalSalesClientsDao
) {
    $dataClient = $request->getParsedBody();

    if (isset($dataClient)) {
        $insert = 0;
        $update = 0;

        $clients = $dataClient['importClients'];

        $dataImportClients = [];
        $debugg = [];

        for ($i = 0; $i < sizeof($clients); $i++) {
            if (
                empty($clients[$i]['firstname']) ||
                empty($clients[$i]['lastname']) ||
                empty($clients[$i]['email'])
            ) {
                $row = $i + 2;
                array_push($debugg, array('error' => true, 'message' => "Campos vacios en la fila: {$row}"));
            }

            if (
                trim($clients[$i]['firstname']) == '' ||
                trim($clients[$i]['lastname']) == '' ||
                trim($clients[$i]['email']) == ''
            ) {
                $row = $i + 2;
                array_push($debugg, array('error' => true, 'message' => "Campos vacios en la fila: {$row}"));
            }

            if ($clients[$i]['group']) {
                $group = $groupsDao->findGroup($clients[$i]);

                if (!$group) {
                    $row = $i + 2;
                    array_push($debugg, array('error' => true, 'message' => "Grupo no existe fila: {$row}"));
                }
            }

            if (sizeof($debugg) == 0) {
                $findClient = $generalSalesClientsDao->findSaleClient($clients[$i]);
                if (!$findClient) $insert = $insert + 1;
                else $update = $update + 1;
                $dataImportClients['insert'] = $insert;
                $dataImportClients['update'] = $update;
            }
        }
    } else
        $dataImportClients = array('error' => true, 'message' => 'El archivo se encuentra vacio. Intente nuevamente');

    $data['import'] = $dataImportClients;
    $data['debugg'] = $debugg;

    $response->getBody()->write(json_encode($data, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addSaleClient', function (Request $request, Response $response, $args) use (
    $salesClientsDao,
    $generalSalesClientsDao,
    $groupsDao
) {
    $dataClient = $request->getParsedBody();

    $count = sizeof($dataClient);

    if ($count > 1) {
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
    } else {
        $clients = $dataClient['importClients'];

        for ($i = 0; $i < sizeof($clients); $i++) {
            $findClient = $generalSalesClientsDao->findSaleClient($clients[$i]);

            if ($clients[$i]['group']) {
                $group = $groupsDao->findGroup($clients[$i]);

                $clients[$i]['idGroup'] = $group['id_group'];
            } else
                $clients[$i]['idGroup'] = 0;

            if (!$findClient) {
                $resolution = $salesClientsDao->addSaleClient($clients[$i]);
            } else {
                $clients[$i]['idSaleClient'] = $findClient['id_sale_client'];
                $resolution = $salesClientsDao->updateSaleClient($clients[$i]);
            }

            if (isset($resolution['info'])) break;
        }

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Clientes importados correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    }

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
    if ($data['id_sale_client'] == $dataClient['idSaleClient'] || $data['id_sale_client'] == 0) {
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
