<?php

namespace crmproyecformas\dao;

use crmproyecformas\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PaymentMethodsDao
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
    $stmt = $connection->prepare("SELECT * FROM payment_methods");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $paymentMethods = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Metodos de pago Obtenidos", array('usuarios' => $paymentMethods));
    return $paymentMethods;
  }

  public function savePaymentMethods($dataPaymentMethod)
  {
    $connection = Connection::getInstance()->getConnection();
    if (!empty($dataPaymentMethod['id_paymentMethod'])) {
      $stmt = $connection->prepare("UPDATE payment_methods SET method = :method WHERE id_method = :id_method");
      $stmt->execute([
        'id_method' => $dataPaymentMethod['id_paymentMethod'],
        'method' => ucwords(strtolower(trim($dataPaymentMethod['paymentMethod'])))
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 2;
    } else {
      $stmt = $connection->prepare("SELECT * FROM payment_methods WHERE method = :method");
      $stmt->execute(['method' => $dataPaymentMethod['paymentMethod']]);
      $rows = $stmt->rowCount();
      $id_payment = $stmt->fetch($connection::FETCH_ASSOC);

      if ($rows > 0) {
        $stmt = $connection->prepare("UPDATE payment_methods SET method = :method WHERE id_method = :id_method");
        $stmt->execute(['method' => ucwords(strtolower(trim($id_payment['id_method'])))]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 2;
      } else {

        $stmt = $connection->prepare("INSERT INTO payment_methods (method) VALUES(:method)");
        $stmt->execute(['method' => ucwords(strtolower(trim($dataPaymentMethod['paymentMethod'])))]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 1;
      }
    }
  }

  public function deletePaymentMethods($paymentMethod)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM payment_methods");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      $stmt = $connection->prepare("DELETE FROM payment_methods WHERE id_method = :id");
      $stmt->execute(['id' => $paymentMethod]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
