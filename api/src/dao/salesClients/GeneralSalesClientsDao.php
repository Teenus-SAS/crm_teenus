<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class GeneralSalesClientsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findSaleClient($dataClient)
    {
        session_start();
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM sales_clients
                                      WHERE email = :email");
        $stmt->execute([
            'email' => trim($dataClient['email'])
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $client = $stmt->fetch($connection::FETCH_ASSOC);
        return $client;
    }

    public function findAllSalesClientsByGroup($id_user, $id_group)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM sales_clients
                                      WHERE id_user = :id_user AND id_group IN ($id_group)");
        $stmt->execute(['id_user' => $id_user]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $client = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $client;
    }
}
