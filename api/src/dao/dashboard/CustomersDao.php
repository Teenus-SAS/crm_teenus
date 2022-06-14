<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class CustomersDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findNewCustomers($id)
  {
    $connection = Connection::getInstance()->getConnection();
    session_start();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT COUNT(*) AS newContacts FROM `companies` 
                                      WHERE created_at 
                                      BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                      AND NOW();");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT COUNT(*) AS newContacts FROM `companies` 
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT COUNT(*) AS newContacts FROM `companies` 
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $newcustomers = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("clientes Obtenidos", array('clientes' => $newcustomers));
    return $newcustomers;
  }

  public function findQuantityCustomers($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT Month(created_at) AS Month, MonthName(created_at) AS MonthName, COUNT(*) AS Quantity
                                    FROM companies
                                    WHERE year(created_at) = year(curdate())
                                    GROUP BY MonthName(created_at) ORDER BY `Month` ASC");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT Month(created_at) AS Month, MonthName(created_at) AS MonthName, COUNT(*) AS Quantity
                                    FROM companies
                                    WHERE year(created_at) = year(curdate()) AND companies.created_by = :id_user
                                    GROUP BY MonthName(created_at) ORDER BY `Month` ASC;");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT Month(created_at) AS Month, MonthName(created_at) AS MonthName, COUNT(*) AS Quantity
                                    FROM companies
                                    WHERE year(created_at) = year(curdate()) AND companies.created_by = :id_user
                                    GROUP BY MonthName(created_at) ORDER BY `Month` ASC;");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $totalpriceorders));
    return $totalpriceorders;
  }
}
