<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SalesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findActualValuedSales()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM sales WHERE year = year(curdate())");
        $stmt->execute();
        $valuedSales = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("zonas Obtenidas", array('zonas' => $valuedSales));
        return $valuedSales;
    }
}
