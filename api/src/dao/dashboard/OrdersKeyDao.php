<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class OrdersKeyDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findTotalPriceOrders($id)
  {
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT q.id_quote, SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))) AS valuedOrders
                                    FROM quotes q 
                                    INNER JOIN orders o ON o.id_quote = q.id_quote
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                    INNER JOIN companies cp ON cp.id_company = c.id_company 
                                    INNER JOIN business b ON b.id_business = q.id_business 
                                    INNER JOIN quotes_products qp ON qp.id_quote = q.id_quote
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    WHERE  o.date_register
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW()");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT q.id_quote, SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))) AS valuedOrders
                                      FROM quotes q 
                                      INNER JOIN orders o ON o.id_quote = q.id_quote
                                      INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                      INNER JOIN companies cp ON cp.id_company = c.id_company 
                                      INNER JOIN business b ON b.id_business = q.id_business 
                                      INNER JOIN quotes_products qp ON qp.id_quote = q.id_quote
                                      INNER JOIN users u ON u.id_user = cp.created_by
                                      WHERE  u.id_user = :id_user AND o.date_register
                                      BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                      AND NOW()");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT q.id_quote, SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))) AS valuedOrders
                                    FROM quotes q 
                                    INNER JOIN orders o ON o.id_quote = q.id_quote
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                    INNER JOIN companies cp ON cp.id_company = c.id_company 
                                    INNER JOIN business b ON b.id_business = q.id_business 
                                    INNER JOIN quotes_products qp ON qp.id_quote = q.id_quote
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    WHERE  u.id_user = :id_user AND o.date_register
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW()");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $totalpriceorders));
    return $totalpriceorders;
  }

  public function findBudgetsvsOrders($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];
    $year = date("Y");

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT SUM(jan) as enero, SUM(feb) as febrero, SUM(mar) as marzo, SUM(apr) as abril, SUM(may) as mayo, 
                                    SUM(june) as junio, SUM(july) as julio, SUM(aug) as agosto, SUM(sept) as septiembre, SUM(oct) as octubre, 
                                    SUM(nov) as noviembre, SUM(decem) as diciembre 
                                    FROM budgets WHERE year = :presentyear;");
        $stmt->execute(['presentyear' => $year]);

        $totalbudgets = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(o.date_register) AS month, SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))) AS won 
                                    FROM orders o
                                    INNER JOIN quotes q ON q.id_quote = o.id_quote INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                    WHERE year(o.date_register) = year(curdate())
                                    GROUP BY MonthName(o.date_register) ORDER BY `month` DESC;");
        $stmt->execute();
        $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT SUM(jan) as enero, SUM(feb) as febrero, SUM(mar) as marzo, SUM(apr) as abril, SUM(may) as mayo, 
                                    SUM(june) as junio, SUM(july) as julio, SUM(aug) as agosto, SUM(sept) as septiembre, SUM(oct) as octubre, 
                                    SUM(nov) as noviembre, SUM(decem) as diciembre 
                                    FROM budgets WHERE year = :presentyear AND id_user = :id_user;");
        $stmt->execute(['id_user' => $id_user, 'presentyear' => $year]);
        $totalbudgets = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(o.date_register) AS month, SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))) AS won 
                                    FROM orders o
                                    INNER JOIN quotes q ON q.id_quote = o.id_quote INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                    INNER JOIN companies c ON q.id_company = c.id_company
                                    WHERE year(o.date_register) = year(curdate()) AND c.created_by = :id_user
                                    GROUP BY MonthName(o.date_register) ORDER BY `month` DESC;");
        $stmt->execute(['id_user' => $id_user]);
        $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT SUM(jan) as enero, SUM(feb) as febrero, SUM(mar) as marzo, SUM(apr) as abril, SUM(may) as mayo, 
                                    SUM(june) as junio, SUM(july) as julio, SUM(aug) as agosto, SUM(sept) as septiembre, SUM(oct) as octubre, 
                                    SUM(nov) as noviembre, SUM(decem) as diciembre 
                                    FROM budgets WHERE year = :presentyear AND id_user = :id_user;");
      $stmt->execute(['id_user' => $id_user, 'presentyear' => $year]);
      $totalbudgets = $stmt->fetchAll($connection::FETCH_ASSOC);

      $stmt = $connection->prepare("SELECT MonthName(o.date_register) AS month, SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))) AS won 
                                    FROM orders o
                                    INNER JOIN quotes q ON q.id_quote = o.id_quote INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                    INNER JOIN companies c ON q.id_company = c.id_company
                                    WHERE year(o.date_register) = year(curdate()) AND c.created_by = :id_user
                                    GROUP BY MonthName(o.date_register) ORDER BY `month` DESC;");
      $stmt->execute(['id_user' => $id_user]);
      $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    }

    $totalbudgetsorders = array_merge($totalbudgets, $totalpriceorders);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("budgetsOrders Obtenidas", array('budgetsOrders' => $totalbudgetsorders));
    return $totalbudgetsorders;
  }

  public function findValuedOrders($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT MonthName(o.date_register) AS month, SUM(qp.price) AS won 
                                    FROM orders o
                                    INNER JOIN quotes q ON q.id_quote = o.id_quote
                                    INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                    WHERE year(o.date_register) = year(curdate())
                                    GROUP BY MonthName(o.date_register);");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT MonthName(o.date_register) AS month, SUM(qp.price) AS won 
        FROM orders o
        INNER JOIN quotes q ON q.id_quote = o.id_quote
        INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
        INNER JOIN companies c ON q.id_company = c.id_company
        WHERE year(o.date_register) = year(curdate()) AND c.created_by = :id_user
        GROUP BY MonthName(o.date_register);");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT MonthName(o.date_register) AS month, SUM(qp.price) AS won 
                                    FROM orders o
                                    INNER JOIN quotes q ON q.id_quote = o.id_quote
                                    INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                    INNER JOIN companies c ON q.id_company = c.id_company
                                    WHERE year(o.date_register) = year(curdate()) AND c.created_by = :id_user
                                    GROUP BY MonthName(o.date_register);");
      $stmt->execute(['id_user' => $id_user]);
    }

    $valuedorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("valued orders ", array('valued orders' => $valuedorders));
    return $valuedorders;
  }
}