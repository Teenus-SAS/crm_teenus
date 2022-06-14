<?php

use crmteenus\dao\UserDao;
use crmteenus\dao\LoginDao;

$userDao = new UserDao();
$loginDao = new LoginDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Autenticación */

$app->post('/user', function (Request $request, Response $response, $args) use ($userDao, $loginDao) {
    $parsedBody = $request->getParsedBody();

    $user = $parsedBody["inputEmailAddress"];
    $password = $parsedBody["inputChoosePassword"];
    $user = $userDao->findByEmail($user);

    $resp = array();

    if ($user == null) {
        $resp = array('error' => true, 'message' => 'Usuario y/o password incorrectos, valide nuevamente');
        $response->getBody()->write(json_encode($resp));
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }

    if ($user['status'] != 1) {
        $resp = array('error' => true, 'message' => 'Usuario Inactivo, valide con el administrador');
        $response->getBody()->write(json_encode($resp));
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }

    $resp = $loginDao->login($password, $user);
    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});


/* Logout */

$app->get('/logout', function (Request $request, Response $response, $args) use ($userDao) {
    session_start();
    session_destroy();
    $response->getBody()->write(json_encode("1", JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
