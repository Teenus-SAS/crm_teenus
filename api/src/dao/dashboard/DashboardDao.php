<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class DashboardDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findNewCustomers($id)
  {
    $connection = Connection::getInstance()->getConnection();
    session_start();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT COUNT(*) AS newContacts FROM `companies` 
                                      WHERE created_at 
                                      BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                      AND NOW();");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT COUNT(*) AS newContacts FROM `companies` 
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT COUNT(*) AS newContacts FROM `companies` 
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $newcustomers = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("clientes Obtenidos", array('clientes' => $newcustomers));
    return $newcustomers;
  }

  public function findNewBusiness($id)
  {
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT COUNT(*) AS newBusiness FROM business b 
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT COUNT(*) AS newBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT COUNT(*) AS newBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company
                                    WHERE created_by = :id_user AND created_at 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $newbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $newbusiness));
    return $newbusiness;
  }

  public function findTotalPriceBusiness($id)
  {
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT SUM(estimated_sale) AS valuedBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    WHERE b.id_phase < 7 AND date_register 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT  SUM(estimated_sale) AS valuedBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    WHERE created_by = :id_user AND b.id_phase < 7 AND date_register 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT  SUM(estimated_sale) AS valuedBusiness FROM business b
                                    INNER JOIN companies cp ON b.id_company = cp.id_company 
                                    WHERE created_by = :id_user AND b.id_phase < 7 AND date_register 
                                    BETWEEN ((CURRENT_DATE - INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY)) 
                                    AND NOW();");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $totalpricebusiness = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("pricebusiness Obtenidas", array('pricebusiness' => $totalpricebusiness));
    return $totalpricebusiness;
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

  public function findQuantityCustomers($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT MonthName(created_at) AS Month, COUNT(*) AS Quantity
                                    FROM companies
                                    WHERE year(created_at) = year(curdate())
                                    GROUP BY MonthName(created_at)");
        $stmt->execute();
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT MonthName(created_at) AS Month, COUNT(*) AS Quantity
                                    FROM companies
                                    WHERE year(created_at) = year(curdate()) AND companies.created_by = :id_user
                                    GROUP BY MonthName(created_at);");
        $stmt->execute(['id_user' => $id_user]);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT MonthName(created_at) AS Month, COUNT(*) AS Quantity
                                    FROM companies
                                    WHERE year(created_at) = year(curdate()) AND companies.created_by = :id_user
                                    GROUP BY MonthName(created_at);");
      $stmt->execute(['id_user' => $id_user]);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("zonas Obtenidas", array('zonas' => $totalpriceorders));
    return $totalpriceorders;
  }

  public function findQuantityBusiness($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == 'undefined') {
        $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 6 
                                    GROUP BY MonthName(date_change_phase);");
        $stmt->execute();
        $totalwonbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 7 
                                    GROUP BY MonthName(date_change_phase);");
        $stmt->execute();
        $totalfailbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $totalbusiness = array_merge($totalwonbusiness, $totalfailbusiness);
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 6 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
        $stmt->execute(['id_user' => $id_user]);
        $totalwonbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 7 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
        $stmt->execute(['id_user' => $id_user]);
        $totalfailbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $totalbusiness = array_merge($totalwonbusiness, $totalfailbusiness);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS won 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 6 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
      $stmt->execute(['id_user' => $id_user]);
      $totalwonbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $stmt = $connection->prepare("SELECT MonthName(date_change_phase) AS month, COUNT(*) AS fail 
                                    FROM business
                                    INNER JOIN companies on companies.id_company = business.id_company 
                                    WHERE year(date_change_phase) = year(curdate()) AND business.id_phase = 7 AND companies.created_by = :id_user
                                    GROUP BY MonthName(date_change_phase);");
      $stmt->execute(['id_user' => $id_user]);
      $totalfailbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $totalbusiness = array_merge($totalwonbusiness, $totalfailbusiness);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //$totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("total Business Obtenidas", array('business' => $totalbusiness));
    return $totalbusiness;
  }

  public function findValuedBusiness($id)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 1) {
      if ($id == '1') {
        $stmt = $connection->prepare("SELECT MonthName(date_register) AS month, SUM(estimated_sale) AS won 
                                    FROM business 
                                    WHERE year(date_register) = year(curdate()) AND id_phase = 6
                                    GROUP BY MonthName(date_register);");
        $stmt->execute();
        $totalwonvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(date_register) AS month, SUM(estimated_sale) AS fail 
                                    FROM business 
                                    WHERE year(date_register) = year(curdate()) AND id_phase = 7
                                    GROUP BY MonthName(date_register);");
        $stmt->execute();
        $totalfailvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $valuedbusiness = array_merge($totalwonvaluedbusiness, $totalfailvaluedbusiness);
      } else {
        $id_user = $id;
        $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS won 
                                      FROM business b
                                      INNER JOIN companies c ON b.id_company = c.id_company
                                      WHERE year(b.date_register) = year(curdate()) AND b.id_phase = 6 AND c.created_by = :id_user
                                      GROUP BY MonthName(b.date_register)");
        $stmt->execute(['id_user' => $id_user]);
        $totalwonvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS fail 
                                      FROM business b
                                      INNER JOIN companies c ON b.id_company = c.id_company
                                      WHERE year(b.date_register) = year(curdate()) AND b.id_phase = 7 AND c.created_by = :id_user
                                      GROUP BY MonthName(b.date_register)");
        $stmt->execute(['id_user' => $id_user]);
        $totalfailvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

        $valuedbusiness = array_merge($totalwonvaluedbusiness, $totalfailvaluedbusiness);
      }
    } else if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS won 
                                    FROM business b
                                    INNER JOIN companies c ON b.id_company = c.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND b.id_phase = 6 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register)");
      $stmt->execute(['id_user' => $id_user]);
      $totalwonvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $stmt = $connection->prepare("SELECT MonthName(b.date_register) AS month, SUM(b.estimated_sale) AS fail 
                                    FROM business b
                                    INNER JOIN companies c ON b.id_company = c.id_company
                                    WHERE year(b.date_register) = year(curdate()) AND b.id_phase = 7 AND c.created_by = :id_user
                                    GROUP BY MonthName(b.date_register)");
      $stmt->execute(['id_user' => $id_user]);
      $totalfailvaluedbusiness = $stmt->fetchAll($connection::FETCH_ASSOC);

      $valuedbusiness = array_merge($totalwonvaluedbusiness, $totalfailvaluedbusiness);
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //$totalpriceorders = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("valued business ", array('valued business' => $valuedbusiness));
    return $valuedbusiness;
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
