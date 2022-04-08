<?php

use crmteenus\dao\UserDao;

$userDao = new UserDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Autenticación */

$app->post('/user', function (Request $request, Response $response, $args) use ($userDao) {
    $parsedBody = $request->getParsedBody();

    $user = $parsedBody["inputEmailAddress"];
    $password = $parsedBody["inputChoosePassword"];
    $user = $userDao->findByEmail($user);

    $resp = array();
    if ($user != null) {
        if ($user['status'] == 1) {
            if (password_verify($password, $user['pass'])) {
                session_start();
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $user['id_user'];
                $_SESSION['name'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['position'] = $user['position'];
                $_SESSION['avatar'] = $user['avatar'];
                $_SESSION['access'] = $user['access_delete_order'];
                $_SESSION["timeout"] = time();
                $resp = array('success' => true, 'message' => $user['rol']);
                $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
                return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
            } else {
                $resp = array('error' => true, 'message' => 'Usuario y/o password incorrectos, valide nuevamente');
                $response->getBody()->write(json_encode($resp));
                return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
            }
        } else {
            $resp = array('error' => true, 'message' => 'Usuario Inactivo, valide con el administrador');
            $response->getBody()->write(json_encode($resp));
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        }
    } else {
        $resp = array('error' => true, 'message' => 'Usuario y/o password incorrectos, valide nuevamente');
        $response->getBody()->write(json_encode($resp));
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
});


/* Logout */

$app->get('/logout', function (Request $request, Response $response, $args) use ($userDao) {
    session_start();
    session_destroy();
    $response->getBody()->write(json_encode("1", JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
