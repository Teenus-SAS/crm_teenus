<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SalesChannelsDao
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
    $stmt = $connection->prepare("SELECT * FROM sales_channels");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $saleschannels = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("canales Obtenidos", array('usuarios' => $saleschannels));
    return $saleschannels;
  }

  public function saveSaleChannel($dataSalesChannels)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataSalesChannels['id_saleChannel'])) {
      $stmt = $connection->prepare("UPDATE sales_channels SET sales_channels = :sales_channels WHERE id_sales_channels = :id_sales_channels");
      $stmt->execute([
        'id_sales_channels' => $dataSalesChannels['id_saleChannel'],
        'sales_channels' => ucwords(strtolower(trim($dataSalesChannels['saleChannel']))),
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {
      $stmt = $connection->prepare("SELECT * FROM sales_channels WHERE sales_channels = :sales_channels");
      $stmt->execute(['sales_channels' => ucwords(strtolower(trim($dataSalesChannels['saleChannel'])))]);
      $rows = $stmt->rowCount();

      if ($rows > 0) {
        $id = $stmt->fetch($connection::FETCH_ASSOC);
        $stmt = $connection->prepare("UPDATE sales_channels SET sales_channels = :sales_channels  WHERE id_sales_channels = :id_sales_channels");
        $stmt->execute([
          'id_sales_channels' => $id,
          'sales_channels' => ucwords(strtolower(trim($dataSalesChannels['saleChannel']))),
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 2;
      } else {

        $stmt = $connection->prepare("INSERT INTO sales_channels (sales_channels) VALUES(:sales_channels)");
        $stmt->execute([
          'sales_channels' => ucwords(strtolower(trim($dataSalesChannels['saleChannel']))),
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 1;
      }
    }
  }

  public function deleteSaleChannel($id)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM sales_channels WHERE id_sales_channels = :id_sales_channels");
    $stmt->execute([
      'id_sales_channels' => $id,
    ]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("DELETE FROM sales_channels WHERE id_sales_channels = :id_sales_channels");
      $stmt->execute([
        'id_sales_channels' => $id,
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
