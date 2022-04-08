<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class BudgetsDao
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
    $year = date("Y");
    $stmt = $connection->prepare("SELECT CONCAT(u.firstname, ' ', u.lastname) as comercial, b.id_budget, b.year, b.jan, b.feb, b.mar, b.apr, b.may, b.june, b.july, b.aug, b.sept, b.oct, b.nov, b.decem 
                                  FROM budgets b INNER JOIN users u ON u.id_user = b.id_user
                                  WHERE u.status > 0 AND year = :year;");
    $stmt->execute(['year' => $year]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $budgets = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("presupuestos Obtenidos", array('presupuestos' => $budgets));
    return $budgets;
  }

  public function findOne()
  {
    session_start();
    $idUser = $_SESSION['idUser'];
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM budgets WHERE id_user = :idUser");
    $stmt->execute(['idUser' => $idUser]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $budgets = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("presupuestos Obtenidos", array('presupuestos' => $budgets));
    return $budgets;
  }

  public function saveBudget($dataBudget)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM budgets WHERE id_user = :id_seller");
    $stmt->execute(['id_seller' => $dataBudget['seller']]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {

      $stmt = $connection->prepare("UPDATE budgets 
                                    SET year = :year, jan = :jan, feb = :feb, mar = :mar, apr = :apr, may = :may, june = :june, july = :july, aug = :aug, sept = :sept, oct = :oct, nov = :nov, decem = :decem 
                                    WHERE id_user = :id_user");
      $stmt->execute([
        'id_user' => str_replace(".", "", $dataBudget['seller']),
        'year' => str_replace(".", "", $dataBudget['year']),
        'jan' => str_replace(".", "", $dataBudget['jan']),
        'feb' => str_replace(".", "", $dataBudget['feb']),
        'mar' => str_replace(".", "", $dataBudget['mar']),
        'apr' => str_replace(".", "", $dataBudget['apr']),
        'may' => str_replace(".", "", $dataBudget['may']),
        'june' => str_replace(".", "", $dataBudget['june']),
        'july' => str_replace(".", "", $dataBudget['july']),
        'aug' => str_replace(".", "", $dataBudget['aug']),
        'sept' => str_replace(".", "", $dataBudget['sept']),
        'oct' => str_replace(".", "", $dataBudget['oct']),
        'nov' => str_replace(".", "", $dataBudget['nov']),
        'decem' => str_replace(".", "", $dataBudget['decem']),

      ]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {

      $stmt = $connection->prepare("INSERT INTO budgets (id_user, year, jan, feb, mar, apr, may, june, july, aug, sept, oct, nov, decem) 
                                    VALUES(:id_user, :year, :jan, :feb, :mar, :apr, :may, :june, :july, :aug, :sept, :oct, :nov, :decem)");
      $stmt->execute([
        'id_user' => str_replace(".", "", $dataBudget['seller']),
        'year' => str_replace(".", "", $dataBudget['year']),
        'jan' => str_replace(".", "", $dataBudget['jan']),
        'feb' => str_replace(".", "", $dataBudget['feb']),
        'mar' => str_replace(".", "", $dataBudget['mar']),
        'apr' => str_replace(".", "", $dataBudget['apr']),
        'may' => str_replace(".", "", $dataBudget['may']),
        'june' => str_replace(".", "", $dataBudget['june']),
        'july' => str_replace(".", "", $dataBudget['july']),
        'aug' => str_replace(".", "", $dataBudget['aug']),
        'sept' => str_replace(".", "", $dataBudget['sept']),
        'oct' => str_replace(".", "", $dataBudget['oct']),
        'nov' => str_replace(".", "", $dataBudget['nov']),
        'decem' => str_replace(".", "", $dataBudget['decem']),

      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 1;
    }
  }

  public function deleteBudget($dataUser)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      $stmt = $connection->prepare("DELETE FROM users WHERE id_user = :id");
      $stmt->execute(['id' => $dataUser['idUser']]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
