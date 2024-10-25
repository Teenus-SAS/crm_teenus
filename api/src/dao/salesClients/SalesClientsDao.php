<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SalesClientsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllSalesClients()
    {
        session_start();
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT *
                                      FROM sales_clients sc");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $client = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $client;
    }

    public function addSaleClient($dataClient)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("INSERT INTO sales_clients
                                            (
                                                firstname,
                                                lastname,
                                                email,
                                                cellphone,
                                                position,
                                                company,
                                                sales
                                            )
                                          VALUES
                                            (
                                                :firstname,
                                                :lastname,
                                                :email,
                                                :cellphone,
                                                :position,
                                                :company,
                                                :sales
                                            )");
            $stmt->execute([
                'firstname' => trim($dataClient['firstname']),
                'lastname' => trim($dataClient['lastname']),
                'email' => trim($dataClient['email']),
                'cellphone' => trim($dataClient['cellphone']),
                'position' => trim($dataClient['position']),
                'company' => trim($dataClient['company']),
                'sales' => trim($dataClient['sales']),
            ]);
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function updateSaleClient($dataClient)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("UPDATE sales_clients
                                          SET
                                            firstname = :firstname,
                                            lastname = :lastname,
                                            email = :email,
                                            cellphone = :cellphone,
                                            position = :position,
                                            company = :company,
                                            sales = :sales
                                          WHERE
                                            id_sale_client = :id_sale_client");
            $stmt->execute([
                'id_sale_client' => $dataClient['idSaleClient'],
                'firstname' => trim($dataClient['firstname']),
                'lastname' => trim($dataClient['lastname']),
                'email' => trim($dataClient['email']),
                'cellphone' => trim($dataClient['cellphone']),
                'position' => trim($dataClient['position']),
                'company' => trim($dataClient['company']),
                'sales' => trim($dataClient['sales']),
            ]);
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function deleteSaleClient($id_sale_client)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM sales_clients WHERE id_sale_client = :id_sale_client");
            $stmt->execute(['id_sale_client' => $id_sale_client]);
            $rows = $stmt->rowCount();

            if ($rows == 1) {
                $stmt = $connection->prepare("DELETE FROM sales_clients WHERE id_sale_client = :id_sale_client");
                $stmt->execute(['id_sale_client' => $id_sale_client]);
                $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
            }
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }
}
