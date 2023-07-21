<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class BillingsKeyDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    /* public function findNewBillings($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $rol = $_SESSION['rol'];

        if ($rol == 1) {
            if ($id == '1') {
                $stmt = $connection->prepare("SELECT COUNT(*) AS newBillings FROM business b 
                                                INNER JOIN companies cp ON b.id_company = cp.id_company
                                                WHERE sp.sales_phase LIKE 'Factura%' AND 
                                                created_at BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                                AND NOW();");
                $stmt->execute();
            } else {
                $id_user = $id;
                $stmt = $connection->prepare("SELECT COUNT(*) AS newBillings FROM business b
                                            INNER JOIN companies cp ON b.id_company = cp.id_company
                                            WHERE created_by = :id_user AND sp.sales_phase LIKE 'Factura%' AND created_at 
                                            BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                            AND NOW();");
                $stmt->execute(['id_user' => $id_user]);
            }
        } else if ($rol == 2) {
            $id_user = $_SESSION['idUser'];
            $stmt = $connection->prepare("SELECT COUNT(*) AS newBillings FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_by = :id_user AND sp.sales_phase LIKE 'Factura%' AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
            $stmt->execute(['id_user' => $id_user]);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $newBillings = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("zonas Obtenidas", array('zonas' => $newBillings));
        return $newBillings;
    } */

    public function findTotalPriceBillings($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $rol = $_SESSION['rol'];

        if ($rol == 1) {
            if ($id == '1') {
                $stmt = $connection->prepare("SELECT SUM(estimated_sale) AS valuedBillings FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase
                                    WHERE sp.sales_phase LIKE 'Factura%' AND date_register 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
                $stmt->execute();
            } else {
                $id_user = $id;
                $stmt = $connection->prepare("SELECT  SUM(estimated_sale) AS valuedBillings FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase
                                    WHERE created_by = :id_user AND sp.sales_phase LIKE 'Factura%' AND date_register 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
                $stmt->execute(['id_user' => $id_user]);
            }
        } else if ($rol == 2) {
            $id_user = $_SESSION['idUser'];
            $stmt = $connection->prepare("SELECT  SUM(estimated_sale) AS valuedBillings FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase
                                    WHERE created_by = :id_user AND sp.sales_phase LIKE 'Factura%' AND date_register 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
            $stmt->execute(['id_user' => $id_user]);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $totalpriceBillings = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("priceBillings Obtenidas", array('priceBillings' => $totalpriceBillings));
        return $totalpriceBillings;
    }

    /* public function findQuantityBillings($id)
    {
        session_start();
        $connection = Connection::getInstance()->getConnection();
        $rol = $_SESSION['rol'];

        if ($rol == 1) {
            if ($id == 'undefined') {
                $stmt = $connection->prepare("SELECT MonthName(b.date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business b
                                    INNER JOIN sales_phases sp ON sp.id_phase = b.id_phase
                                    WHERE year(b.date_change_phase) = year(curdate()) AND sp.sales_phase LIKE 'Factura%'                                     GROUP BY MonthName(date_change_phase);");
                $stmt->execute();
                $totalwonBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND Billings.id_phase = 7 
                                    GROUP BY MonthName(date_change_phase);");
                $stmt->execute();
                $totalfailBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $totalBillings = array_merge($totalwonBillings, $totalfailBillings);
            } else {
                $id_user = $id;
                $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = Billings.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND Billings.id_phase = 6 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
                $stmt->execute(['id_user' => $id_user]);
                $totalwonBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = Billings.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND Billings.id_phase = 7 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
                $stmt->execute(['id_user' => $id_user]);
                $totalfailBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $totalBillings = array_merge($totalwonBillings, $totalfailBillings);
            }
        } else if ($rol == 2) {
            $id_user = $_SESSION['idUser'];
            $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = Billings.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND Billings.id_phase = 6 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
            $stmt->execute(['id_user' => $id_user]);
            $totalwonBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

            $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = Billings.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND Billings.id_phase = 7 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
            $stmt->execute(['id_user' => $id_user]);
            $totalfailBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

            $totalBillings = array_merge($totalwonBillings, $totalfailBillings);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        //$totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("total Billings Obtenidas", array('Billings' => $totalBillings));
        return $totalBillings;
    }

    public function findValuedBillings($id)
    {
        session_start();
        $connection = Connection::getInstance()->getConnection();
        $rol = $_SESSION['rol'];

        if ($rol == 1) {
            if ($id == '1') {
                $stmt = $connection->prepare("SELECT MonthName(date_register) AS month, SUM(estimated_sale) AS won 
                                    FROM business 
                                    WHERE year(date_register) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND id_phase = 6
                                    GROUP BY MonthName(date_register);");
                $stmt->execute();
                $totalwonvaluedBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $stmt = $connection->prepare("SELECT MonthName(date_register) AS month, SUM(estimated_sale) AS fail 
                                    FROM business 
                                    WHERE year(date_register) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND id_phase = 7
                                    GROUP BY MonthName(date_register);");
                $stmt->execute();
                $totalfailvaluedBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $valuedBillings = array_merge($totalwonvaluedBillings, $totalfailvaluedBillings);
            } else {
                $id_user = $id;
                $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS won 
                                      FROM business b
                                      INNER JOIN companies c ON b.id_company = c.id_company
                                      WHERE year(b.date_register) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND b.id_phase = 6 AND c.created_by = :id_user
                                      GROUP BY MonthName(b.date_register)");
                $stmt->execute(['id_user' => $id_user]);
                $totalwonvaluedBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS fail 
                                      FROM business b
                                      INNER JOIN companies c ON b.id_company = c.id_company
                                      WHERE year(b.date_register) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND b.id_phase = 7 AND c.created_by = :id_user
                                      GROUP BY MonthName(b.date_register)");
                $stmt->execute(['id_user' => $id_user]);
                $totalfailvaluedBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

                $valuedBillings = array_merge($totalwonvaluedBillings, $totalfailvaluedBillings);
            }
        } else if ($rol == 2) {
            $id_user = $_SESSION['idUser'];
            $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON b.id_company = c.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND b.id_phase = 6 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register)");
            $stmt->execute(['id_user' => $id_user]);
            $totalwonvaluedBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

            $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS fail 
                                    FROM business b
                                    INNER JOIN companies c ON b.id_company = c.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND sp.sales_phase LIKE 'Factura%' AND b.id_phase = 7 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register)");
            $stmt->execute(['id_user' => $id_user]);
            $totalfailvaluedBillings = $stmt->fetchAll($connection::FETCH_ASSOC);

            $valuedBillings = array_merge($totalwonvaluedBillings, $totalfailvaluedBillings);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        //$totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("valued Billings ", array('valued Billings' => $valuedBillings));
        return $valuedBillings;
    } */
}
