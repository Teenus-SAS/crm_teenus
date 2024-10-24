<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ContactsDao
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
    // $rol = $_SESSION['rol'];
    $connection = Connection::getInstance()->getConnection();

    // if ($rol == 1) {
    $stmt = $connection->prepare("SELECT
                                    -- Columnas
                                      c.id_contact,
                                      c.firstname,
                                      c.lastname,
                                      c.phone,
                                      c.phone1,
                                      c.email,
                                      c.position,
                                      IFNULL(cp.id_company, 0) AS id_company,
                                      IFNULL(cp.company_name, '') AS company_name
                                  FROM contacts c
                                    LEFT JOIN companies cp ON c.id_company = cp.id_company
                                  ORDER BY `cp`.`company_name` ASC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $contacts = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get contacts", array('contacts' => $contacts));
    return $contacts;
    // } else if ($rol == 2) {
    //   $id_user = $_SESSION['idUser'];
    //   $stmt = $connection->prepare("SELECT c.id_contact, c.firstname, c.lastname, c.phone, c.phone1, c.email, c.position, cp.id_company, cp.company_name
    //                                   FROM contacts c 
    //                                   INNER JOIN companies cp ON c.id_company = cp.id_company 
    //                                   WHERE cp.created_by = :id_user 
    //                                   ORDER BY `cp`.`company_name` ASC");
    //   $stmt->execute(['id_user' => $id_user]);
    //   $contacts = $stmt->fetchAll($connection::FETCH_ASSOC);

    //   $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //   $this->logger->notice("get contacts", array('contacts' => $contacts));
    //   return $contacts;
    // }
  }

  public function saveContact($dataContact)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM contacts WHERE id_contact = :id_contact");
    $stmt->execute(['id_contact' => $dataContact['id_contact']]);
    $rows = $stmt->rowCount();

    if ($rows >= 1) {

      $stmt = $connection->prepare("UPDATE contacts SET firstname = :firstname, 
                                    lastname = :lastname, phone = :phone, phone1 = :phone1, email = :email, 
                                    position = :position, id_company = :id_company WHERE id_contact = :id_contact");
      $stmt->execute([
        'firstname' => ucwords(strtolower(trim($dataContact['names']))),
        'lastname' => ucwords(strtolower(trim($dataContact['lastname']))),
        'phone' => trim($dataContact['phone1']),
        'phone1' => trim($dataContact['phone2']),
        'email' => strtolower(trim($dataContact['email'])),
        'position' => ucwords(strtolower(trim($dataContact['position']))),
        'id_company' => trim($dataContact['company']),
        'id_contact' => trim($dataContact['id_contact'])
      ]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {

      // $stmt = $connection->prepare("SELECT * FROM contacts WHERE email = :email");
      // $stmt->execute(['email' => $dataContact['email']]);
      // $rows = $stmt->rowCount();

      // if ($rows == 0) {
      $stmt = $connection->prepare("INSERT INTO contacts (firstname, lastname, phone, phone1, email, position, id_company) VALUES(:firstname, :lastname, :phone, :phone1, :email, :position, :id_company)");
      $stmt->execute([
        'firstname' => ucwords(strtolower(trim($dataContact['names']))),
        'lastname' => ucwords(strtolower(trim($dataContact['lastname']))),
        'phone' => trim($dataContact['phone1']),
        'phone1' => trim($dataContact['phone2']),
        'email' => strtolower(trim($dataContact['email'])),
        'position' => ucwords(strtolower(trim($dataContact['position']))),
        'id_company' => trim($dataContact['company'])
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 1;
      // } else
      //   return 0;
    }
  }

  public function deleteContact($dataContact)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM contacts");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      $stmt = $connection->prepare("DELETE FROM contacts WHERE id_contact = :id");
      $stmt->execute(['id' => $dataContact['id_contact']]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
