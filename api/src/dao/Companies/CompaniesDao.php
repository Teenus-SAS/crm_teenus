<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class CompaniesDao
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
    $rol = $_SESSION['rol'];
    $connection = Connection::getInstance()->getConnection();

    if ($rol == 1) {
      $stmt = $connection->prepare("SELECT c.id_company, c.nit, c.company_name, c.address, c.phone, c.city, CONCAT(u.firstname, ' ', u.lastname) as seller, c.sales, cg.category, s.subcategory
                                  FROM companies c INNER JOIN users u ON u.id_user = c.created_by 
                                  INNER JOIN subcategories s ON s.id_subcategory = c.id_subcategory 
                                  INNER JOIN categories cg ON cg.id_category = s.id_category 
                                  ORDER BY `c`.`company_name` ASC;");
      $stmt->execute([]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $companies = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("get companies", array('companies' => $companies));
      return $companies;
    } else  if ($rol == 2) {

      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT c.id_company, c.nit, c.company_name, c.address, c.phone, c.city, CONCAT(u.firstname, ' ', u.lastname) as seller, c.sales, cg.category, s.subcategory
                                      FROM companies c LEFT JOIN users u ON u.id_user = c.created_by 
                                      LEFT JOIN subcategories s ON s.id_subcategory = c.id_subcategory 
                                      LEFT JOIN categories cg ON cg.id_category = s.id_category 
                                      WHERE created_by = :id_user
                                      ORDER BY `c`.`company_name` ASC;");
      $stmt->execute(['id_user' => $id_user]);
      $companies = $stmt->fetchAll($connection::FETCH_ASSOC);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $this->logger->notice("get contacts", array('contacts' => $companies));
      return $companies;
    }
  }

  public function findCompany($dataCompany)
  {
    $connection = Connection::getInstance()->getConnection();
    $sql = "SELECT * FROM companies WHERE company_name = :company_name";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
      'company_name' => ucwords(strtolower(trim($dataCompany['company_name']))),
    ]);
    $rows = $stmt->rowCount();
    return $rows;
  }

  public function insertCompany($dataCompany)
  {
    try {
      $connection = Connection::getInstance()->getConnection();

      session_start();
      $id_user = $_SESSION['idUser'];

      $dataCompany['subcategory'] == null ? $dataCompany['subcategory'] = 1 : $dataCompany['subcategory'];

      $stmt = $connection->prepare("INSERT INTO companies (nit, company_name, address, phone, city, id_subcategory, created_by) 
                                  VALUES(:nit, :company_name, :address, :phone, :city, :id_subcategory, :created_by)");
      $stmt->execute([
        'nit' => trim($dataCompany['nit']),
        'company_name' => strtoupper(trim($dataCompany['company_name'])),
        'address' => trim($dataCompany['address']),
        'phone' => trim($dataCompany['phone']),
        'city' => ucwords(strtolower(trim($dataCompany['city']))),
        'id_subcategory' => $dataCompany['subcategory'],
        'created_by' => $id_user
      ]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }



  public function updateCompany($dataCompany)
  {

    try {
      $connection = Connection::getInstance()->getConnection();

      $sql = "UPDATE companies SET nit = :nit, company_name = :company_name, address = :address, 
                phone = :phone, city = :city, sales = :sales, id_subcategory = :id_subcategory
              WHERE id_company = :id_company";
      $stmt = $connection->prepare($sql);
      $stmt->execute([
        'id_company' => trim($dataCompany['id_company']),
        'nit' => trim($dataCompany['nit']),
        'company_name' => strtoupper(trim($dataCompany['company_name'])),
        'address' => trim($dataCompany['address']),
        'phone' => trim($dataCompany['phone']),
        'city' => ucwords(strtolower(trim($dataCompany['city']))),
        'sales' => ucwords(trim($dataCompany['salesCompany'])),
        'id_subcategory' => trim($dataCompany['subcategory']),
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function deleteCompany($dataCompanie)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM companies");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      $stmt = $connection->prepare("DELETE FROM companies WHERE id_user = :id");
      $stmt->execute(['id' => $dataCompanie['idUser']]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }

  public function reassignCompany($id_company, $id_seller)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM companies WHERE id_company = :id_company");
    $stmt->execute(['id_company' => $id_company]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("UPDATE companies SET created_by = :id_seller WHERE id_company = :id_company");
      $stmt->execute(['id_company' => $id_company, 'id_seller' => $id_seller]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }

  public function reassignCompanies($id_seller, $id_seller_old)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("UPDATE companies SET created_by = :id_seller WHERE created_by = :id_seller_old;");
    $stmt->execute(['id_seller' => $id_seller, 'id_seller_old' => $id_seller_old]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
  }
}
