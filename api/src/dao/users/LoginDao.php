<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LoginDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function login($password, $user)
  {
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

      $resp = array('success' => true, 'message' => $_SESSION['rol']);
    } else
      $resp = array('error' => true, 'message' => 'Usuario y/o password incorrectos, valide nuevamente');

    return $resp;
  }
}
