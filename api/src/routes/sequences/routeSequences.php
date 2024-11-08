<?php

use crmteenus\dao\SequencesDao;

$sequencesDao = new SequencesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/sequences', function (Request $request, Response $response, $args) use (
    $sequencesDao
) {
    $sequences = $sequencesDao->findAllSequences();
    $response->getBody()->write(json_encode($sequences));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addSequence', function (Request $request, Response $response, $args) use (
    $sequencesDao
) {
    $dataSequence = $request->getParsedBody();

    $sequence = $sequencesDao->findSequence($dataSequence);

    if (!$sequence) {
        $resolution = $sequencesDao->insertSequence($dataSequence);

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Secuencia creado correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    } else
        $resp = ['info' => true, 'message' => 'La secuencia ya se encuentra registrado. Intente con una nueva'];

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->post('/updateSequence', function (Request $request, Response $response, $args) use (
    $sequencesDao
) {
    $dataSequence = $request->getParsedBody();

    $sequence = $sequencesDao->findSequence($dataSequence);

    !is_array($sequence) ? $data['id_sequence'] = 0 : $data = $sequence;
    if ($data['id_sequence'] == $dataSequence['idSequence'] || $data['id_sequence'] == 0) {
        $resolution = $sequencesDao->updateSequence($dataSequence);

        if ($resolution == null)
            $resp = ['success' => true, 'message' => 'Secuencia modificada correctamente'];
        else if (isset($resolution['info']))
            $resp = ['info' => true, 'message' => $resolution['message']];
        else
            $resp = ['error' => true, 'message' => 'Ocurrio un error al guardar la información. Intente nuevamente'];
    } else
        $resp = ['info' => true, 'message' => 'La secuencia ya se encuentra registrado. Intente con uno nuevo'];

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->get('/deleteSequence/{id_sequence}', function (Request $request, Response $response, $args) use ($sequencesDao) {
    $resolution = $sequencesDao->deleteSequence($args['id_sequence']);

    if ($resolution == null)
        $resp = ['success' => true, 'message' => 'Secuencia eliminada correctamente'];
    else if (isset($resolution['info']))
        $resp = ['info' => true, 'message' => $resolution['message']];
    else
        $resp = ['error' => true, 'message' => 'Ocurrio un error al eliminar la información. Intente nuevamente'];

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
