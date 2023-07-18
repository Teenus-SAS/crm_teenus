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
        $stmt = $connection->prepare("SELECT IFNULL(q.id_quote, 0) AS id_quote, IFNULL(SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))), 0) AS valuedOrders
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
        $stmt = $connection->prepare("SELECT IFNULL(q.id_quote, 0) AS id_quote, IFNULL(SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))), 0) AS valuedOrders
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
      $stmt = $connection->prepare("SELECT IFNULL(q.id_quote, 0) AS id_quote, IFNULL(SUM((qp.price * qp.quantity) * (1 - (qp.discount/100))), 0) AS valuedOrders
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

  public function findBudgetsvsBill($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];
    $year = date("Y");

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT IFNULL(SUM(jan), 0) as enero, IFNULL(SUM(feb), 0) as febrero, IFNULL(SUM(mar), 0) as marzo, IFNULL(SUM(apr), 0) as abril, IFNULL(SUM(may), 0) as mayo, 
                                             IFNULL(SUM(june), 0) as junio, IFNULL(SUM(july), 0) as julio, IFNULL(SUM(aug), 0) as agosto, IFNULL(SUM(sept), 0) as septiembre, IFNULL(SUM(oct), 0) as octubre, 
                                             IFNULL(SUM(nov), 0) as noviembre, IFNULL(SUM(decem), 0) as diciembre
                                    FROM budgets WHERE year = :presentyear;");
        $stmt->execute(['presentyear' => $year]);

        $totalbudgets = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, IFNULL(SUM(b.estimated_sale), 0) AS won 
                                    FROM business b
                                    WHERE year(b.date_register) = year(curdate()) AND b.num_bill > 0
                                    GROUP BY MonthName(b.date_register) ORDER BY `month` DESC;");
        $stmt->execute();
        $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT IFNULL(SUM(jan), 0) as enero, IFNULL(SUM(feb), 0) as febrero, IFNULL(SUM(mar), 0) as marzo, IFNULL(SUM(apr), 0) as abril, IFNULL(SUM(may), 0) as mayo, 
                                             IFNULL(SUM(june), 0) as junio, IFNULL(SUM(july), 0) as julio, IFNULL(SUM(aug), 0) as agosto, IFNULL(SUM(sept), 0) as septiembre, IFNULL(SUM(oct), 0) as octubre, 
                                             IFNULL(SUM(nov), 0) as noviembre, IFNULL(SUM(decem), 0) as diciembre
                                    FROM budgets WHERE year = :presentyear AND id_user = :id_user;");
        $stmt->execute(['id_user' => $id_user, 'presentyear' => $year]);
        $totalbudgets = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, IFNULL(SUM(b.estimated_sale), 0) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON c.id_company = b.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND b.num_bill > 0 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register) ORDER BY `month` DESC");
        $stmt->execute(['id_user' => $id_user]);
        $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT IFNULL(SUM(jan), 0) as enero, IFNULL(SUM(feb), 0) as febrero, IFNULL(SUM(mar), 0) as marzo, IFNULL(SUM(apr), 0) as abril, IFNULL(SUM(may), 0) as mayo, 
                                           IFNULL(SUM(june), 0) as junio, IFNULL(SUM(july), 0) as julio, IFNULL(SUM(aug), 0) as agosto, IFNULL(SUM(sept), 0) as septiembre, IFNULL(SUM(oct), 0) as octubre, 
                                           IFNULL(SUM(nov), 0) as noviembre, IFNULL(SUM(decem), 0) as diciembre
                                    FROM budgets WHERE year = :presentyear AND id_user = :id_user;");
      $stmt->execute(['id_user' => $id_user, 'presentyear' => $year]);
      $totalbudgets = $stmt->fetchAll($connection::FETCH_ASSOC);

      $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, IFNULL(SUM(b.estimated_sale), 0) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON c.id_company = b.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND b.num_bill > 0 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register) ORDER BY `month` DESC");
      $stmt->execute(['id_user' => $id_user]);
      $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    }

    $totalbudgetsorders = array_merge($totalbudgets, $totalpriceorders);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("budgetsOrders Obtenidas", array('budgetsOrders' => $totalbudgetsorders));
    return $totalbudgetsorders;
  }

  public function findValuedBill($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, IFNULL(SUM(b.estimated_sale), 0) AS won 
                                    FROM business b
                                    WHERE year(b.date_register) = year(curdate()) AND b.num_bill > 0
                                    GROUP BY MonthName(b.date_register) ORDER BY `month` DESC");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, IFNULL(SUM(b.estimated_sale), 0) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON c.id_company = b.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND b.num_bill > 0 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register) ORDER BY `month` DESC");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, IFNULL(SUM(b.estimated_sale), 0) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON c.id_company = b.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND b.num_bill > 0 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register) ORDER BY `month` DESC");
      $stmt->execute(['id_user' => $id_user]);
    }

    $valuedorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("valued orders ", array('valued orders' => $valuedorders));
    return $valuedorders;
  }
}
