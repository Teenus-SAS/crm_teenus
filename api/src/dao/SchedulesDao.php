<?php

namespace crmproyecformas\dao;

use crmproyecformas\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SchedulesDao
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

    if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ', u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company 
                                  INNER JOIN users u ON u.id_user = cp.created_by 
                                  WHERE t.status > 0 AND cp.created_by = :id_user 
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute(['id_user' => $id_user]);
    } else if ($rol == 1) {
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ', u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company 
                                  INNER JOIN users u ON u.id_user = cp.created_by WHERE t.status > 0 
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute();
    }
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $tasks = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get schedules", array('schedules' => $tasks));
    return $tasks;
  }

  public function findAllCompleted()
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ', u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company
                                  INNER JOIN users u ON u.id_user = cp.created_by
                                  WHERE t.status = 0 AND cp.created_by = :id_user
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute(['id_user' => $id_user]);
    } else if ($rol == 1) {
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ', u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                    FROM schedules t 
                                    INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                    INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                    INNER JOIN companies cp ON cp.id_company = c.id_company
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    WHERE t.status = 0
                                    ORDER BY `t`.`due_date` ASC");
      $stmt->execute();
    }
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $tasks = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get schedules", array('schedules' => $tasks));
    return $tasks;
  }

  public function findAllTaskToday()
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ', u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company
                                  INNER JOIN users u ON u.id_user = cp.created_by
                                  WHERE t.status = 1 AND due_date = CURDATE() AND cp.created_by = :id_user
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute(['id_user' => $id_user]);
    } else if ($rol == 1) {
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ', u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company
                                  INNER JOIN users u ON u.id_user = cp.created_by
                                  WHERE t.status = 1 AND due_date = CURDATE()
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute();
    }
    $tasks = $stmt->fetchAll($connection::FETCH_ASSOC);

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("get schedules", array('schedules' => $tasks));
    return $tasks;
  }

  public function findAllTaskDelay()
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ',u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company 
                                  INNER JOIN users u ON u.id_user = cp.created_by 
                                  WHERE t.status = 1 AND due_date < CURDATE() AND cp.created_by = :id_user
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute(['id_user' => $id_user]);
    } else if ($rol == 1) {
      $stmt = $connection->prepare("SELECT t.id_schedule, CONCAT(u.firstname,' ',u.lastname) AS asesor, cf.contact_form, t.description, CONCAT(c.firstname, ' ', c.lastname ) as contact, cp.company_name, t.due_date, t.status 
                                  FROM schedules t 
                                  INNER JOIN contact_forms cf ON cf.id_contact_form = t.id_contact_form 
                                  INNER JOIN contacts c ON c.id_contact = t.id_contact 
                                  INNER JOIN companies cp ON cp.id_company = c.id_company 
                                  INNER JOIN users u ON u.id_user = cp.created_by
                                  WHERE t.status = 1 AND due_date < CURDATE()
                                  ORDER BY `t`.`due_date` ASC");
      $stmt->execute();
    }

    $tasks = $stmt->fetchAll($connection::FETCH_ASSOC);

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("get schedules", array('schedules' => $tasks));
    return $tasks;
  }

  public function saveSchedule($dataSchedule)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataSchedule['id_schedule'])) {

      $stmt = $connection->prepare("UPDATE schedules
                                    SET id_schedule = :id_schedule, id_contact_form = :id_contact_form, description = :description, id_company = :id_company, id_contact = :id_contact, due_date = :due_date 
                                    WHERE id_schedule = :id_schedule");
      $stmt->execute([
        'id_schedule' => $dataSchedule['id_schedule'],
        'id_contact_form' => $dataSchedule['contactForms'],
        'id_company' => $dataSchedule['company'],
        'id_contact' => $dataSchedule['contact'],
        'due_date' => $dataSchedule['fechaAccion'],
        'description' => ucfirst(strtolower(trim($dataSchedule['descriptionAction']))),
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {
      session_start();
      /*$rol = $_SESSION['rol'];

      if ($rol == 1) {
        $stmt = $connection->prepare("INSERT INTO schedules (id_contact_form,  description, id_company, id_contact, due_date, id_user, status ) 
                                    VALUES(:id_contact_form, :description, :id_company, :id_contact, :due_date, :id_user, :status)");
        $stmt->execute([
          'id_contact_form' => $dataSchedule['contactForms'],
          'description' => $dataSchedule['descriptionAction'],
          'id_company' => $dataSchedule['company'],
          'id_contact' => $dataSchedule['contact'],
          'due_date' => $dataSchedule['fechaAccion'],
          'id_user' => $dataSchedule['seller'],
          'status' => '1',

        ]);
      } else if ($rol == 2) { */
      $stmt = $connection->prepare("INSERT INTO schedules (id_contact_form,  description, id_company, id_contact, due_date, status ) 
                                    VALUES(:id_contact_form, :description, :id_company, :id_contact, :due_date, :status)");
      $stmt->execute([
        'id_contact_form' => $dataSchedule['contactForms'],
        'description' => ucfirst(strtolower(trim($dataSchedule['descriptionAction']))),
        'id_company' => $dataSchedule['company'],
        'id_contact' => $dataSchedule['contact'],
        'due_date' => $dataSchedule['fechaAccion'],
        'status' => '1',

      ]);
      /* } */
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 1;
    }
  }

  public function deleteSchedule($dataSchedule)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM schedules WHERE id_schedule = :id_schedule");
    $stmt->execute(['id_schedule' => $dataSchedule['idTask']]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("UPDATE schedules SET status = :status WHERE id_schedule = :id_schedule");
      $stmt->execute([
        'status' => '0',
        'id_schedule' => $dataSchedule['idTask']
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return '1';
    }
  }

  public function activateSchedule($dataSchedule)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM schedules WHERE id_schedule = :id_schedule");
    $stmt->execute(['id_schedule' => $dataSchedule['idTask']]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("UPDATE schedules SET status = :status WHERE id_schedule = :id_schedule");
      $stmt->execute([
        'status' => '1',
        'id_schedule' => $dataSchedule['idTask']
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return '1';
    }
  }
}
