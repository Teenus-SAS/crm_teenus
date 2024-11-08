<?php

use crmteenus\dao\GroupsDao;

$groupsDao = new GroupsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/groups', function (Request $request, Response $response, $args) use (
    $groupsDao
) {
    session_start();
    $id_user = $_SESSION['idUser'];
    $groups = $groupsDao->findAllGroups($id_user);
    $response->getBody()->write(json_encode($groups));
    return $response->withHeader('Content-Type', 'application/json');
});

/* checkear data importe
$app->post('/salesClientsDataValidation', function (Request $request, Response $response, $args) use (
    $salesClientsDao,
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
}); */

/* Insertar y actualizar usuario */
$app->post('/addGroup', function (Request $request, Response $response, $args) use (
    $groupsDao
) {
    session_start();
    $id_user = $_SESSION['idUser'];
    $dataGroup = $request->getParsedBody();

    // $count = sizeof($dataClient);

    // if ($count > 1) {
    $group = $groupsDao->findGroup($dataGroup);

    if (!$group) {
        $resolution = $groupsDao->insertGroup($dataGroup, $id_user);

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Grupo creado correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    } else
        $resp = ['info' => true, 'message' => 'El grupo ya se encuentra registrado. Intente con uno nuevo'];
    // } else {
    //     $clients = $dataClient['importClients'];

    //     for ($i = 0; $i < sizeof($clients); $i++) {
    //         $findClient = $generalSalesClientsDao->findSaleClient($clients[$i]);

    //         if (!$findClient) {
    //             $resolution = $salesClientsDao->addSaleClient($clients[$i]);
    //         } else {
    //             $clients[$i]['idSaleClient'] = $findClient['id_group'];
    //             $resolution = $salesClientsDao->updateSaleClient($clients[$i]);
    //         }

    //         if (isset($resolution['info'])) break;
    //     }

    //     if ($resolution == null)
    //         $resp = ['success' => true, 'message' => 'Clientes importados correctamente'];
    //     else if (isset($resolution['info']))
    //         $resp = ['info' => true, 'message' => $resolution['message']];
    //     else
    //         $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    // }

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->post('/updateGroup', function (Request $request, Response $response, $args) use (
    $groupsDao
) {
    $dataGroup = $request->getParsedBody();

    $group = $groupsDao->findGroup($dataGroup);

    !is_array($group) ? $data['id_group'] = 0 : $data = $group;
    if ($data['id_group'] == $dataGroup['idGroup'] || $data['id_group'] == 0) {
        $resolution = $groupsDao->updateGroup($dataGroup);

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Grupo modificado correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    } else
        $resp = ['info' => true, 'message' => 'El grupo ya se encuentra registrado. Intente con uno nuevo'];

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->get('/deleteGRoup/{id_group}', function (Request $request, Response $response, $args) use ($groupsDao) {
    $resolution = $groupsDao->deleteGroup($args['id_group']);

    if ($resolution == null)
        $resp = ['success' => true, 'message' => 'Grupo eliminado correctamente'];
    else if (isset($resolution['info']))
        $resp = ['info' => true, 'message' => $resolution['message']];
    else
        $resp = ['error' => true, 'message' => 'Ocurrio un error al eliminar la información. Intente nuevamente'];

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
