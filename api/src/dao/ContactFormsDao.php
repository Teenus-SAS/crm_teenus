<?php

namespace crmproyecformas\dao;

use crmproyecformas\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ContactFormsDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM contact_forms");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $contactForms = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("formas de contacto Obtenidos", array('Formas' => $contactForms));
    return $contactForms;
  }

  public function saveContactForms($dataContactForms)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataContactForms['id_contactForm'])) {
      $stmt = $connection->prepare("UPDATE contact_forms SET contact_form = :contact_form WHERE id_contact_form = :id_contact_forms");
      $stmt->execute([
        'id_contact_forms' => $dataContactForms['id_contactForm'],
        'contact_form' => ucwords(strtolower(trim($dataContactForms['contactForm'])))
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {
      $stmt = $connection->prepare("SELECT * FROM contact_forms WHERE contact_form = :contact_form");
      $stmt->execute(['contact_form' => $dataContactForms['contactForm']]);
      $rows = $stmt->rowCount();
      $id_contact = $stmt->fetch($connection::FETCH_ASSOC);

      if ($rows > 0) {
        $stmt = $connection->prepare("UPDATE contact_forms SET contact_form = :contact_form WHERE id_contact_form = :id_contact_form");
        $stmt->execute([
          'id_contact_form' => $id_contact['id_contact_form'],
          'contact_form' => ucwords(strtolower(trim($dataContactForms['contactForm'])))
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 2;
      } else {

        $stmt = $connection->prepare("INSERT INTO contact_forms (contact_form) VALUES(:contact_form)");
        $stmt->execute(['contact_form' => ucwords(strtolower(trim($dataContactForms['contactForm'])))]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 1;
      }
    }
  }

  public function deleteContactForms($id)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM contact_forms");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      $stmt = $connection->prepare("DELETE FROM contact_forms WHERE id_contact_form = :id_contact_forms");
      $stmt->execute(['id_contact_forms' => $id]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
