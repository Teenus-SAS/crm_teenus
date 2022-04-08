<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class UserDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1)
      $stmt = $connection->prepare("SELECT * FROM users WHERE rol = 2  ORDER BY firstname");
    else if ($rol == 4)
      $stmt = $connection->prepare("SELECT * FROM users ORDER BY firstname");

    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $users = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("usuarios Obtenidos", array('usuarios' => $users));
    return $users;
  }

  public function findByEmail($Datauser)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM users u WHERE email = :email");
    $stmt->execute(['email' => $Datauser]);
    $user = $stmt->fetch($connection::FETCH_ASSOC);

    if ($user == false) {
      $stmt = $connection->prepare("SELECT * FROM users u WHERE email = :email");
      $stmt->execute(['email' => $Datauser]);
      $user = $stmt->fetch($connection::FETCH_ASSOC);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("usuarios Obtenidos", array('usuarios' => $user));
    return $user;
  }

  public function findUser()
  {
    session_start();
    $email = $_SESSION['email'];

    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM users u WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetchAll($connection::FETCH_ASSOC);

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("usuario Obtenido", array('usuario' => $user));
    return $user;
  }

  public function inactivateActivateUser($id_user)
  {

    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $stmt->execute(['id_user' => $id_user]);
    $users = $stmt->fetch($connection::FETCH_ASSOC);

    $users['status'] == 0 ? $status = 1 : $status = 0;

    $stmt = $connection->prepare("UPDATE users SET status = :statusUser WHERE id_user = :id_user");
    $stmt->execute([
      'id_user' => $id_user,
      'statusUser' => $status
    ]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return $status;
  }


  public function saveUser($dataUser)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataUser['id_user'])) {

      $stmt = $connection->prepare("SELECT * FROM users WHERE id_user = :id_user");
      $stmt->execute(['id_user' => $dataUser['id_user']]);
      $rows = $stmt->rowCount();

      if ($rows > 0) {
        if (!empty($dataUser['password'])) {
          $pass = password_hash($dataUser['password'], PASSWORD_DEFAULT);
          $stmt = $connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, pass = :pass, position = :position, access_delete_order = :access
                                        WHERE id_user = id_user");
          $stmt->execute([
            'firstname' => ucwords(strtolower(trim($dataUser['names']))),
            'lastname' => ucwords(strtolower(trim($dataUser['lastnames']))),
            'pass' => $pass,
            'position' => $dataUser['position'],
            'access' => $dataUser['accessDeletePedidos'],
            'id_user' => $dataUser['id_user'],
          ]);
        } else {
          $stmt = $connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, position = :position , access_delete_order = :access
                                        WHERE id_user = :id_user");
          $stmt->execute([
            'firstname' => ucwords(strtolower(trim($dataUser['names']))),
            'lastname' => ucwords(strtolower(trim($dataUser['lastnames']))),
            'position' => $dataUser['position'],
            'access' => $dataUser['accessDeletePedidos'],
            'id_user' => $dataUser['id_user'],
          ]);
        }
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 3;
      }
    } else {

      try {
        $pass = password_hash($dataUser['password'], PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, email, pass, rol, position, access_delete_order) 
                                    VALUES(:firstname, :lastname, :email, :pass, :rol, :position, :access)");
        $stmt->execute([
          'firstname' => ucwords(strtolower(trim($dataUser['names']))),
          'lastname' => ucwords(strtolower(trim($dataUser['lastnames']))),
          'email' => $dataUser['email'],
          'pass' => $pass,
          'rol' => $dataUser['rol'],
          'position' => $dataUser['position'],
          'access' => $dataUser['accessDeletePedidos'],
        ]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 2;
      } catch (\Exception $e) {
        $message = substr($e->getMessage(), 0, 15);

        if ($message == 'SQLSTATE[23000]')
          $message = 'Email ya registrado. Ingrese un nuevo email';

        $error = array('info' => true, 'message' => $message);
        return $error;
      }
    }
  }

  public function updateUser($dataUser, $avatar, $cont)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $dataUser['email']]);
    $users = $stmt->fetch($connection::FETCH_ASSOC);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      if ($avatar == null) {
        $stmt = $connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, cellphone = :cellphone WHERE id_user = :id_user");
        $stmt->execute([
          'firstname' => ucwords(strtolower(trim($dataUser['names']))),
          'lastname' => ucwords(strtolower(trim($dataUser['lastnames']))),
          'cellphone' => $dataUser['cellphone'],
          'id_user' => $users['id_user']
        ]);
      } else {
        if ($cont == 1) {
          $stmt = $connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, cellphone = :cellphone, avatar = :avatar WHERE id_user = :id_user");
          $stmt->execute([
            'firstname' => ucwords(strtolower(trim($dataUser['names']))),
            'lastname' => ucwords(strtolower(trim($dataUser['lastnames']))),
            'cellphone' => $dataUser['cellphone'],
            'avatar' => $avatar,
            'id_user' => $users['id_user']
          ]);
        } else {
          $stmt = $connection->prepare("UPDATE users SET signature = :signature WHERE id_user = :id_user");
          $stmt->execute([
            'signature' => $avatar,
            'id_user' => $users['id_user']
          ]);
        }
      }

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 1;
    }
  }

  public function deleteUser($dataUser)
  {
    $connection = Connection::getInstance()->getConnection();

    try {
      $stmt = $connection->prepare("SELECT * FROM users");
      $stmt->execute();
      $rows = $stmt->rowCount();

      if ($rows > 1) {
        $stmt = $connection->prepare("DELETE FROM users WHERE id_user = :id");
        $stmt->execute(['id' => $dataUser['idUser']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      }
    } catch (\Exception $e) {
      $message = substr($e->getMessage(), 0, 15);

      if ($message == 'SQLSTATE[23000]')
        $message = 'El usuario no se puede eliminar, tiene registros asociados';

      $error = array('info' => true, 'message' => $message);
      return $error;
    }
  }

  public function ChangePasswordUser($id_user, $newPass)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $stmt->execute(['id_user' => $id_user]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $pass = password_hash($newPass, PASSWORD_DEFAULT);

      $stmt = $connection->prepare("UPDATE users SET pass = :pass WHERE id_user = :id_user");
      $stmt->execute(['id_user' => $id_user, 'pass' => $pass]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }

  public function forgotPasswordUser($email)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {

      $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $longitudCadena = strlen($cadena);
      $new_pass = "";
      $longitudPass = 6;

      for ($i = 1; $i <= $longitudPass; $i++) {
        $pos = rand(0, $longitudCadena - 1);
        $new_pass .= substr($cadena, $pos, 1);
      }

      /* actualizar $pass en la DB */
      $pass = password_hash($new_pass, PASSWORD_DEFAULT);
      $stmt = $connection->prepare("UPDATE users SET pass = :pass WHERE email = :email");
      $stmt->execute(['email' => $email, 'pass' => $pass]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

      /* Enviar $new_pass por email */
      return $new_pass;
    }
  }
}
