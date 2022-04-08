<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ZonesDao
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
    $stmt = $connection->prepare("SELECT * FROM zones");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $zones = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $zones));
    return $zones;
  }

  public function findAllZonesAssigned()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT uz.id_users_zone, CONCAT(u.firstname, ' ', u.lastname) AS asesor, z.zone 
                                  FROM users_zones uz 
                                  INNER JOIN users u ON u.id_user = uz.id_user 
                                  INNER JOIN zones z ON z.id_zone = uz.id_zone 
                                  ORDER BY `z`.`zone` ASC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $zones = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $zones));
    return $zones;
  }


  public function saveZones($dataZone)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM zones WHERE zone = :zone");
    $stmt->execute(['zone' => $dataZone['zone']]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("UPDATE zones SET zone = :zone WHERE zone = :zone");
      $stmt->execute(['zone' => $dataZone['zone']]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {

      $stmt = $connection->prepare("INSERT INTO zones (zone) VALUES(:zone)");
      $stmt->execute(['zone' => $dataZone['zone']]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 1;
    }
  }

  public function saveZonesAssigned($dataassignedzone)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataassignedzone['id_assignedZone'])) {
      $stmt = $connection->prepare("UPDATE users_zones SET id_user = :id_user, id_zone = :id_zone WHERE id_users_zone = :id_users_zone");
      $stmt->execute([
        'id_user' => $dataassignedzone['seller'],
        'id_zone' => $dataassignedzone['zone'],
        'id_users_zone' => $dataassignedzone['id_assignedZone']
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {
      $stmt = $connection->prepare("SELECT * FROM users_zones WHERE id_zone = :id_zone");
      $stmt->execute(['id_zone' => $dataassignedzone['zone']]);
      $rows = $stmt->rowCount();

      if ($rows == 0) {
        $stmt = $connection->prepare("INSERT INTO users_zones (id_user, id_zone) VALUES(:id_user, :id_zone)");
        $stmt->execute([
          'id_user' => $dataassignedzone['seller'],
          'id_zone' => $dataassignedzone['zone']
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 1;
      } else {
        return 3;
      }
    }
  }

  public function deleteZone($dataZone)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM zones");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      try {
        $stmt = $connection->prepare("DELETE FROM zones WHERE id_zone = :id_zone");
        $stmt->execute(['id_zone' => $dataZone]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      } catch (\Throwable $th) {
        $error =  $th->getMessage();
        return $error;
      }
    }
  }
  
  public function deleteZonesAssigned($id)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM users_zones");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      try {
        $stmt = $connection->prepare("DELETE FROM users_zones WHERE id_users_zone = :id_users_zone");
        $stmt->execute(['id_users_zone' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      } catch (\Throwable $th) {
        $error =  $th->getMessage();
        return $error;
      }
    }
  }
}
