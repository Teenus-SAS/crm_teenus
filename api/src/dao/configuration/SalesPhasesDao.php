<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SalesPhasesDao
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
    $stmt = $connection->prepare("SELECT * FROM sales_phases -- WHERE sales_phase != 'Facturacion'");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $salesPhases = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("fases de venta Obtenidas", array('usuarios' => $salesPhases));
    return $salesPhases;
  }

  public function saveSalesPhases($dataSalePhases)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataSalePhases['id_salePhase'])) {
      $stmt = $connection->prepare("UPDATE sales_phases SET sales_phase = :sales_phase, percent = :percent WHERE id_phase = :id_phase");
      $stmt->execute([
        'id_phase' => $dataSalePhases['id_salePhase'],
        'sales_phase' => ucwords(strtolower(trim($dataSalePhases['salePhase']))),
        'percent' => ($dataSalePhases['oportunity'] / 100)
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {
      $stmt = $connection->prepare("SELECT * FROM sales_phases WHERE sales_phase = :sales_phase");
      $stmt->execute(['sales_phase' => $dataSalePhases['salePhase']]);
      $rows = $stmt->rowCount();

      if ($rows > 0) {
        $id_phase = $stmt->fetch($connection::FETCH_ASSOC);
        $stmt = $connection->prepare("UPDATE sales_phases SET sales_phase = :sales_phase, percent = :percent  WHERE id_phase = :id_phase");
        $stmt->execute([
          'id_phase' => $id_phase['id_phase'],
          'sales_phase' => ucwords(strtolower(trim($dataSalePhases['salePhase']))),
          'percent' => ($dataSalePhases['oportunity'] / 100)
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 2;
      } else {

        $stmt = $connection->prepare("INSERT INTO sales_phases (sales_phase, percent) VALUES(:sales_phase, :percent)");
        $stmt->execute([
          'sales_phase' => ucwords(strtolower(trim($dataSalePhases['salePhase']))),
          'percent' => ($dataSalePhases['oportunity'] / 100)
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 1;
      }
    }
  }

  public function deleteSalesPhases($id_salePhases)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM sales_phases WHERE id_phase = :id_phase");
    $stmt->execute([
      'id_phase' => $id_salePhases,
    ]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("DELETE FROM sales_phases WHERE id_phase = :id_phase");
      $stmt->execute([
        'id_phase' => $id_salePhases,
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
