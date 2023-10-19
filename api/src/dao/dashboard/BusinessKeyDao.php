<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class BusinessKeyDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findNewBusiness($id)
  {
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT COUNT(*) AS newBusiness FROM business b 
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT COUNT(*) AS newBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT COUNT(*) AS newBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $newbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $newbusiness));
    return $newbusiness;
  }

  public function findTotalPriceBusiness($id)
  {
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT SUM(estimated_sale) AS valuedBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    WHERE -- b.id_phase < 7 AND 
                                    date_change_phase 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT  SUM(estimated_sale) AS valuedBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    WHERE created_by = :id_user -- AND b.id_phase < 7 
                                    AND date_change_phase 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT  SUM(estimated_sale) AS valuedBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    WHERE created_by = :id_user -- AND b.id_phase < 7 
                                    AND date_change_phase 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $totalpricebusiness = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("pricebusiness Obtenidas", array('pricebusiness' => $totalpricebusiness));
    return $totalpricebusiness;
  }

  public function findQuantityNewBusiness($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];
    $stmt = $connection->prepare("SET lc_time_names = 'es_ES'");
    $stmt->execute();

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT Month(date_change_phase) AS Month, MonthName(date_change_phase) AS MonthName, COUNT(*) AS Quantity 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate())
                                    GROUP BY MonthName(date_change_phase) ORDER BY `Month` ASC");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT Month(date_change_phase) AS Month, MonthName(date_change_phase) AS MonthName, COUNT(*) AS Quantity
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company
                                    WHERE year(date_change_phase) = year(curdate()) AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase) ORDER BY `Month` ASC");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT Month(date_change_phase) AS Month, MonthName(date_change_phase) AS MonthName, COUNT(*) AS Quantity
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company
                                    WHERE year(date_change_phase) = year(curdate()) AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase) ORDER BY `Month` ASC");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $totalpriceorders));
    return $totalpriceorders;
  }

  public function findQuantityBusiness($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];
    $stmt = $connection->prepare("SET lc_time_names = 'es_ES'");
    $stmt->execute();

    if ($rol == 1) {
      if ($id == 'undefined') {
        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) -- AND business.id_phase = 5 
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
        $stmt->execute();
        $totalwonbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 9
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
        $stmt->execute();
        $totalfailbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $totalbusiness = array_merge($totalwonbusiness, $totalfailbusiness);
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) -- AND business.id_phase = 5 
                                    AND companies.created_by = :id_user 
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
        $stmt->execute(['id_user' => $id_user]);
        $totalwonbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 9 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
        $stmt->execute(['id_user' => $id_user]);
        $totalfailbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $totalbusiness = array_merge($totalwonbusiness, $totalfailbusiness);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company
                                    WHERE year(date_change_phase) = year(curdate()) -- AND business.id_phase = 5 
                                    AND companies.created_by = :id_user 
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
      $stmt->execute(['id_user' => $id_user]);
      $totalwonbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 9 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
      $stmt->execute(['id_user' => $id_user]);
      $totalfailbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $totalbusiness = array_merge($totalwonbusiness, $totalfailbusiness);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //$totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("total Business Obtenidas", array('business' => $totalbusiness));
    return $totalbusiness;
  }

  public function findValuedBusiness($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];
    $stmt = $connection->prepare("SET lc_time_names = 'es_ES'");
    $stmt->execute();

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, SUM(estimated_sale) AS won 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) -- AND id_phase = 5
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
        $stmt->execute();
        $totalwonvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(date_change_phase) AS month, SUM(estimated_sale) AS fail 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) AND id_phase = 9
                                    GROUP BY MonthName(date_change_phase)
                                    ORDER BY `numMonth` ASC");
        $stmt->execute();
        $totalfailvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $valuedbusiness = array_merge($totalwonvaluedbusiness, $totalfailvaluedbusiness);
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(b.date_change_phase) AS month, SUM(b.estimated_sale) AS won 
                                      FROM business b
                                      INNER JOIN companies c ON b.id_company = c.id_company
                                      WHERE year(b.date_change_phase) = year(curdate()) AND b.id_phase = 5 AND c.created_by = :id_user
                                      GROUP BY MonthName(b.date_change_phase)
                                      ORDER BY `numMonth` ASC");
        $stmt->execute(['id_user' => $id_user]);
        $totalwonvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth,  MonthName(b.date_change_phase) AS month, SUM(b.estimated_sale) AS fail 
                                      FROM business b
                                      INNER JOIN companies c ON b.id_company = c.id_company
                                      WHERE year(b.date_change_phase) = year(curdate()) AND b.id_phase = 9 AND c.created_by = :id_user
                                      GROUP BY MonthName(b.date_change_phase)
                                      ORDER BY `numMonth` ASC");
        $stmt->execute(['id_user' => $id_user]);
        $totalfailvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $valuedbusiness = array_merge($totalwonvaluedbusiness, $totalfailvaluedbusiness);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(b.date_change_phase) AS month, SUM(b.estimated_sale) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON b.id_company = c.id_company
                                    WHERE year(b.date_change_phase) = year(curdate()) -- AND b.id_phase = 5 
                                    AND c.created_by = :id_user 
                                    GROUP BY MonthName(b.date_change_phase)
                                    ORDER BY `numMonth` ASC");
      $stmt->execute(['id_user' => $id_user]);
      $totalwonvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $stmt = $connection->prepare("SELECT month(date_change_phase) AS numMonth, MonthName(b.date_change_phase) AS month, SUM(b.estimated_sale) AS fail 
                                    FROM business b
                                    INNER JOIN companies c ON b.id_company = c.id_company
                                    WHERE year(b.date_change_phase) = year(curdate()) AND b.id_phase = 9 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_change_phase)
                                    ORDER BY `numMonth` ASC");
      $stmt->execute(['id_user' => $id_user]);
      $totalfailvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $valuedbusiness = array_merge($totalwonvaluedbusiness, $totalfailvaluedbusiness);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //$totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("valued business ", array('valued business' => $valuedbusiness));
    return $valuedbusiness;
  }
}
