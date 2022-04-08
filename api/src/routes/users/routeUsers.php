<?php

use crmteenus\dao\UserDao;

$userDao = new UserDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/users', function (Request $request, Response $response, $args) use ($userDao) {
    $users = $userDao->findAll();
    $response->getBody()->write(json_encode($users, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/user', function (Request $request, Response $response, $args) use ($userDao) {
    $users = $userDao->findUser();
    $response->getBody()->write(json_encode($users, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addUser', function (Request $request, Response $response, $args) use ($userDao) {
    $dataUser = $request->getParsedBody();


    if (empty($dataUser['names']) && empty($dataUser['lastnames']) && empty($dataUser['email'])) /* { */
        $resp = array('error' => true, 'message' => 'Complete todos los datos');

    $users = $userDao->saveUser($dataUser);

    if ($users == 1)
        $resp = array('error' => true, 'message' => 'El email ya se encuentra registrado. Intente con uno nuevo');
    else if ($users == 2)
        $resp = array('success' => true, 'message' => 'Usuario creado correctamente');
    else if ($users == 3)
        $resp = array('success' => true, 'message' => 'Usuario actualizado correctamente');
    else
        $resp = $users;

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->post('/updateUser', function (Request $request, Response $response, $args) use ($userDao) {
    $dataUser = $request->getParsedBody();
    $files = $request->getUploadedFiles();

    if (empty($dataUser['names']) && empty($dataUser['lastnames'])) {
        $resp = array('error' => true, 'message' => 'Ingrese sus Nombres y Apellidos completos');
    } else {
        $cont = 1;
        foreach ($files as $file) {
            $name = $file->getClientFilename();
            $name = explode(".", $name);
            $ext = array_pop($name);
            $ext = strtolower($ext);

            if (empty($ext)) {
                $path = null;
                if ($cont == 2)
                    $users = $userDao->updateUser($dataUser, $path, $cont);
                $cont = $cont + 1;
            } else {

                if (!in_array($ext, ["jpeg", "jpg", "png"])) {
                    $resp = array('error' => true, 'message' => 'La imagen cargada no es valida');
                    $response->getBody()->write(json_encode($resp));
                    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
                } else {
                    if ($cont == 1) {
                        $file->moveTo("../app/assets/images/avatars/" . $name[0] . '.' . $ext);
                        $path = "../../../app/assets/images/avatars/" . $name[0] . '.' . $ext;
                    } else {
                        $file->moveTo("../app/assets/images/signatures/" . $name[0] . '.' . $ext);
                        $path = "../../../app/assets/images/signatures/" . $name[0] . '.' . $ext;
                    }
                    $users = $userDao->updateUser($dataUser, $path, $cont);
                    $cont = $cont + 1;
                }
            }
        }

        $cont = 1;
        if ($users == 1)
            $resp = array('success' => true, 'message' => 'Usuario actualizado correctamente');
        else
            $resp = array('error' => true, 'message' => 'Ocurrio un error, Intente nuevamente');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->post('/deleteUser', function (Request $request, Response $response, $args) use ($userDao) {
    $dataUser = $request->getParsedBody();
    $users = $userDao->deleteUser($dataUser);
    $response->getBody()->write(json_encode($users, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});