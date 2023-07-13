<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class BusinessDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll($rol)
  {
    $connection = Connection::getInstance()->getConnection();

    if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT b.id_business, b.name_business, c.company_name as company, CONCAT(ct.firstname,' ',ct.lastname) as contact, b.estimated_sale, sp.id_phase, sp.sales_phase, sp.percent, b.observation, b.term, b.date_register, CONCAT(u.firstname, ' ',u.lastname) AS seller 
                                  FROM business b 
                                  INNER JOIN companies c ON b.id_company = c.id_company 
                                  INNER JOIN contacts ct ON ct.id_contact = b.id_contact 
                                  INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase 
                                  INNER JOIN users u ON u.id_user = c.created_by
                                  WHERE c.created_by = :id_user AND sp.sales_phase != 'Facturacion'
                                  ORDER BY `b`.`id_business` DESC");
      $stmt->execute(['id_user' => $id_user]);
    } else {
      $stmt = $connection->prepare("SELECT b.id_business, b.name_business, c.company_name as company, CONCAT(ct.firstname,' ',ct.lastname) as contact, b.estimated_sale, sp.id_phase, sp.sales_phase, sp.percent, b.observation, b.term, b.date_register, CONCAT(u.firstname, ' ',u.lastname) AS seller
                                    FROM business b 
                                    INNER JOIN companies c ON b.id_company = c.id_company 
                                    INNER JOIN contacts ct ON ct.id_contact = b.id_contact 
                                    INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase
                                    INNER JOIN users u ON u.id_user = c.created_by
                                    WHERE sp.sales_phase != 'Facturacion'
                                    ORDER BY `b`.`id_business` DESC");
      $stmt->execute();
    }
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $business = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get business", array('business' => $business));
    return $business;
  }

  public function findAllbySeller($id_seller)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT b.id_business, b.name_business, c.company_name as company, CONCAT(ct.firstname,' ',ct.lastname) as contact, b.estimated_sale, sp.id_phase, sp.sales_phase, sp.percent, b.observation, b.term, b.date_register 
                                  FROM business b 
                                  INNER JOIN companies c ON b.id_company = c.id_company 
                                  INNER JOIN contacts ct ON ct.id_contact = b.id_contact 
                                  INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase 
                                  WHERE c.created_by = :id_seller");
    $stmt->execute(['id_seller' => $id_seller]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $business = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get business", array('business' => $business));
    return $business;
  }

  public function findAllbyCompany($id_company)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT b.id_business, b.name_business, c.company_name as company, CONCAT(ct.firstname,' ',ct.lastname) as contact, b.estimated_sale, sp.id_phase, sp.sales_phase, sp.percent, b.observation, b.term, b.date_register
                                  FROM business b 
                                  INNER JOIN companies c ON b.id_company = c.id_company 
                                  INNER JOIN contacts ct ON ct.id_contact = b.id_contact 
                                  INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase 
                                  WHERE c.id_company = :id_company");
    $stmt->execute(['id_company' => $id_company]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $business = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get business", array('business' => $business));
    return $business;
  }

  public function saveBusiness($dataBusiness)
  {
    $connection = Connection::getInstance()->getConnection();
    session_start();

    $price = str_replace(".", "", $dataBusiness['saleEstimated']);

    if (!empty($dataBusiness['id_business'])) {

      $stmt = $connection->prepare("UPDATE business 
                                    SET name_business = :name_business, id_company = :id_company, id_contact = :id_contact, estimated_sale = :estimated_sale,
                                    id_phase = :id_phase, observation = :observation, term =:term, date_change_phase = NOW()
                                    WHERE id_business = :id_business");
      $stmt->execute([
        'id_business' => $dataBusiness['id_business'],
        'name_business' => ucfirst(strtolower(trim($dataBusiness['name_business']))),
        'id_company' => $dataBusiness['company'],
        'id_contact' => $dataBusiness['contact'],
        'estimated_sale' => $price,
        'id_phase' => $dataBusiness['selectSalesPhase'],
        'observation' => ucfirst(strtolower(trim($dataBusiness['businessObservations']))),
        'term' => $dataBusiness['term'],
      ]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {

      $stmt = $connection->prepare("INSERT INTO business (name_business, id_company, id_contact, estimated_sale, id_phase, observation, term) 
                                      VALUES(:name_business, :id_company, :id_contact, :estimated_sale, :id_phase, :observation, :term)");
      $stmt->execute([
        'name_business' => ucwords(strtolower(trim($dataBusiness['name_business']))),
        'id_company' => $dataBusiness['company'],
        'id_contact' => $dataBusiness['contact'],
        'estimated_sale' => $price,
        'id_phase' => $dataBusiness['selectSalesPhase'],
        'observation' => ucwords(strtolower(trim($dataBusiness['businessObservations']))),
        'term' => $dataBusiness['term'],
      ]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      //return 1;
    }
  }
}
