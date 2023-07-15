<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class BillingsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllBillings($rol)
    {
        $connection = Connection::getInstance()->getConnection();

        if ($rol == 2) {
            $id_user = $_SESSION['idUser'];
            $stmt = $connection->prepare("SELECT b.id_business, b.name_business, c.company_name as company, CONCAT(ct.firstname,' ',ct.lastname) as contact, b.estimated_sale, sp.id_phase, sp.sales_phase, sp.percent, b.observation, b.term, b.date_register, CONCAT(u.firstname, ' ',u.lastname) AS seller 
                                  FROM business b 
                                  INNER JOIN companies c ON b.id_company = c.id_company 
                                  INNER JOIN contacts ct ON ct.id_contact = b.id_contact 
                                  INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase 
                                  INNER JOIN users u ON u.id_user = c.created_by
                                  WHERE c.created_by = :id_user AND sp.sales_phase = 'Facturacion'
                                  ORDER BY `b`.`id_business` DESC");
            $stmt->execute(['id_user' => $id_user]);
        } else {
            $stmt = $connection->prepare("SELECT b.id_business, b.name_business, c.company_name as company, CONCAT(ct.firstname,' ',ct.lastname) as contact, b.estimated_sale, sp.id_phase, sp.sales_phase, sp.percent, b.observation, b.term, b.date_register, CONCAT(u.firstname, ' ',u.lastname) AS seller
                                    FROM business b 
                                    INNER JOIN companies c ON b.id_company = c.id_company 
                                    INNER JOIN contacts ct ON ct.id_contact = b.id_contact 
                                    INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase
                                    INNER JOIN users u ON u.id_user = c.created_by
                                    WHERE sp.sales_phase = 'Facturacion'
                                    ORDER BY `b`.`id_business` DESC");
            $stmt->execute();
        }
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $billings = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("get billings", array('billings' => $billings));
        return $billings;
    }

    public function insertNumBill($dataBusinnes)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            $stmt = $connection->prepare("UPDATE business SET num_bill = :num_bill WHERE id_business = :id_business");
            $stmt->execute([
                'num_bill' => $dataBusinnes['numBill'],
                'id_business' => $dataBusinnes['idBusinnes']
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
