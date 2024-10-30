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
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT 
                                        sc.id_sale_client,
                                        sc.id_group,
                                        IFNULL(g.name_group, '') AS name_group,
                                        sc.firstname,
                                        sc.lastname,
                                        sc.email,
                                        sc.cellphone,
                                        sc.position,
                                        sc.company,
                                        sc.sales,
                                        IFNULL(u.id_user, 0) AS id_user,
                                        IFNULL(u.firstname, '') AS firstname_user,
                                        IFNULL(u.lastname, '') AS lastname_user,
                                        IFNULL(u.email, '') AS email_user
                                      FROM sales_clients sc
                                        LEFT JOIN groups g ON g.id_group = sc.id_group
                                        LEFT JOIN users u ON u.id_user = sc.id_user");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $client = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $client;
    }

    public function addSaleClient($dataClient, $id_user)
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
                                                sales,
                                                id_group,
                                                id_user
                                            )
                                          VALUES
                                            (
                                                :firstname,
                                                :lastname,
                                                :email,
                                                :cellphone,
                                                :position,
                                                :company,
                                                :sales,
                                                :id_group,
                                                :id_user
                                            )");
            $stmt->execute([
                'firstname' => trim($dataClient['firstname']),
                'lastname' => trim($dataClient['lastname']),
                'email' => trim($dataClient['email']),
                'cellphone' => trim($dataClient['cellphone']),
                'position' => trim($dataClient['position']),
                'company' => trim($dataClient['company']),
                'sales' => trim($dataClient['sales']),
                'id_group' => $dataClient['idGroup'],
                'id_user' => $id_user
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
                                            sales = :sales,
                                            id_group = :id_group
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
                'id_group' => $dataClient['idGroup']
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
