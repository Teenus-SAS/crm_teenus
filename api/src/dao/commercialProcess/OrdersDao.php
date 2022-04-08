<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class OrdersDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 2) {
      $id_user = $_SESSION['idUser'];
      $stmt = $connection->prepare("SELECT o.id_quote, o.id_order, cp.company_name, b.name_business, SUM((qp.quantity * qp.price) * (1 - (qp.discount/100))) AS price, 
                                           CONCAT(c.firstname, ' ', c.lastname) AS contact, CONCAT(u.firstname, ' ', u.lastname) AS asesor, 
                                           o.date_register, rm.status 
                                    FROM orders o 
                                    INNER JOIN quotes q ON o.id_quote = q.id_quote 
                                    INNER JOIN companies cp ON cp.id_company = q.id_company 
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                    INNER JOIN business b ON b.id_business = q.id_business 
                                    INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                    LEFT JOIN remissions rm ON rm.id_order = o.id_order
                                    INNER JOIN users u ON u.id_user = cp.created_by 
                                    WHERE cp.created_by = :id_user AND o.status > 0 
                                    GROUP BY id_quote ORDER BY `o`.`id_order` DESC;");
      $stmt->execute(['id_user' => $id_user]);
    } else if ($rol == 1) {
      $stmt = $connection->prepare("SELECT o.id_quote, o.id_order, cp.company_name, b.name_business, SUM((qp.quantity * qp.price) * (1 - (qp.discount/100))) AS price, 
                                          CONCAT(c.firstname, ' ', c.lastname) AS contact, CONCAT(u.firstname, ' ', u.lastname) AS asesor, 
                                          u.access_delete_order, o.date_register, rm.status
                                    FROM orders o INNER JOIN quotes q ON o.id_quote = q.id_quote
                                    INNER JOIN companies cp ON cp.id_company = q.id_company
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact
                                    INNER JOIN business b ON b.id_business = q.id_business
                                    INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote
                                    LEFT JOIN remissions rm ON rm.id_order = o.id_order
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    WHERE o.status > 0 GROUP BY id_order
                                    ORDER BY `o`.`id_order` DESC;");
      $stmt->execute();
    } else if ($rol == 3) {
      $stmt = $connection->prepare("SELECT o.id_quote, o.id_order, cp.company_name, b.name_business, CONCAT(c.firstname, ' ', c.lastname) AS contact, 
                                           CONCAT(u.firstname, ' ', u.lastname) AS asesor, u.access_delete_order, o.date_register, 
                                           b.estimated_sale as price, rm.status
                                    FROM orders o INNER JOIN quotes q ON o.id_quote = q.id_quote
                                    INNER JOIN companies cp ON cp.id_company = q.id_company
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact
                                    INNER JOIN business b ON b.id_business = q.id_business
                                    LEFT JOIN remissions rm ON rm.id_order = o.id_order
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    WHERE o.status > 0 GROUP BY id_order
                                    ORDER BY `o`.`id_order` DESC;");
      $stmt->execute();
    }


    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $quotes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get quotes", array('quotes' => $quotes));
    return $quotes;
  }

  public function findOrderById($id_order, $id_remission)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT o.id_order, CONCAT(c.firstname, ' ',c.lastname) AS contact, cp.nit, cp.company_name, cp.address, c.email AS email_customer, q.id_quote, 
                                          q.date_register, q.id_business, b.name_business, qp.id_quote_product, p.reference, p.product, p.description, qp.quantity, qp.delivered, qp.price, qp.discount, p.img,
                                          CONCAT(u.firstname, ' ', u.lastname) AS seller, u.email, o.date_register,
                                          odd.purchase_order, odd.advance_date, odd.advance_value, odd.policy_number, odd.date_delivery, odd.contact_delivery, odd.address_delivery, odd.phone, odd.city, odd.observation, CONCAT(u.firstname, ' ',u.lastname) AS asesor, u.position, u.cellphone, u.signature 
                                  FROM orders o 
                                  INNER JOIN quotes q ON o.id_quote = q.id_quote 
                                  INNER JOIN quotes_products qp ON o.id_quote = qp.id_quote
                                  INNER JOIN products p ON p.id_product = qp.id_product
                                  INNER JOIN order_data_delivery odd ON odd.id_order = o.id_order 
                                  INNER JOIN companies cp ON cp.id_company = q.id_company 
                                  INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                  INNER JOIN business b ON b.id_business = q.id_business 
                                  INNER JOIN users u ON u.id_user = cp.created_by 
                                  WHERE o.id_order = :id_order AND odd.id_remission = :id_remission;");
    $stmt->execute(['id_order' => $id_order, 'id_remission' => $id_remission]);


    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $order = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get order", array('order' => $order));
    return $order;
  }

  public function findOrderByIdQuote($id_quote)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM orders WHERE id_quote = :id_quote AND status > 0;");
    $stmt->execute(['id_quote' => $id_quote]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $order = $stmt->fetch($connection::FETCH_ASSOC);
    $this->logger->notice("get order", array('order' => $order));
    return $order;
  }

  public function saveOrder($dataOrder)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM orders WHERE id_quote = :id_quote AND status > 0");
    $stmt->execute(['id_quote' => $dataOrder['id']]);
    $rows = $stmt->rowCount();

    if ($rows == 0) {
      /* Ingresa la order */

      $stmt = $connection->prepare("INSERT INTO orders (id_quote) VALUES(:id_quote)");
      $stmt->execute(['id_quote' => $dataOrder['id']]);

      /* Obtiene el Id de la orden ingresada */

      $stmt = $connection->prepare("SELECT MAX(id_order) AS id FROM orders");
      $stmt->execute();
      $order = $stmt->fetch($connection::FETCH_ASSOC);

      /* Ingresa los datos para la entrega */
      $advance_value = trim($dataOrder['advance_value']);
      $advance_value = str_replace(".", "", $advance_value);

      $stmt = $connection->prepare("INSERT INTO order_data_delivery (id_order, purchase_order, advance_date, advance_value, policy_number, date_delivery, contact_delivery, address_delivery, phone, city, observation) 
                                    VALUES(:id_order, :purchase_order, :advance_date, :advance_value, :policy_number, :date_delivery, :contact_delivery, :address_delivery, :phone, :city, :observation)");
      $stmt->execute([
        'id_order' => $order['id'],
        'purchase_order' => trim($dataOrder['purchase_order']),
        'advance_date' => trim($dataOrder['advance_date']),
        'advance_value' => $advance_value,
        'policy_number' => trim($dataOrder['policy']),
        'date_delivery' => $dataOrder['date_delivery'],
        'contact_delivery' => ucwords(strtolower(trim($dataOrder['contact_delivery']))),
        'address_delivery' => ucwords(strtolower(trim($dataOrder['address_delivery']))),
        'phone' => $dataOrder['phone'],
        'city' => ucwords(strtolower(trim($dataOrder['city']))),
        'observation' => ucfirst(strtolower(trim($dataOrder['observation']))),
      ]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return 1;
    }
  }

  public function updateDataDeliveryOrder($dataOrder)
  {
    session_start();
    $connection = Connection::getInstance()->getConnection();
    $rol = $_SESSION['rol'];

    if ($rol == 2) {

      $stmt = $connection->prepare("SELECT * FROM order_data_delivery WHERE id_order = :id_order AND id_remission = :id_remission");
      $stmt->execute(['id_order' => $dataOrder['id'], 'id_remission' => 0]);
      $rows = $stmt->rowCount();

      if ($rows == 0) {
        $stmt = $connection->prepare("INSERT INTO order_data_delivery (id_order, purchase_order, advance_date, advance_value, policy_number, date_delivery, contact_delivery, address_delivery, phone, city, observation) 
                                    VALUES(:id_order, :purchase_order, :advance_date, :advance_value, :policy_number, :date_delivery, :contact_delivery, :address_delivery, :phone, :city, :observation)");
      } else {
        $stmt = $connection->prepare("UPDATE order_data_delivery 
                                    SET purchase_order = :purchase_order, advance_date = :advance_date, advance_value = :advance_value, policy_number = :policy_number, date_delivery = :date_delivery, contact_delivery = :contact_delivery, 
                                          address_delivery = :address_delivery, phone = :phone, city = :city, observation = :observation 
                                    WHERE id_order = :id_order AND id_remission = :id_remission");
      }

      $advance_value = trim($dataOrder['advance_value']);
      $advance_value = str_replace(".", "", $advance_value);

      $stmt->execute([
        'id_order' => $dataOrder['id'],
        'id_remission' => $dataOrder['id_remission'],
        'purchase_order' => trim($dataOrder['purchase_order']),
        'advance_date' => trim($dataOrder['advance_date']),
        'advance_value' => $advance_value,
        'policy_number' => trim($dataOrder['policy']),
        'date_delivery' => $dataOrder['date_delivery'],
        'contact_delivery' => ucwords(strtolower(trim($dataOrder['contact_delivery']))),
        'address_delivery' => ucwords(strtolower(trim($dataOrder['address_delivery']))),
        'phone' => $dataOrder['phone'],
        'city' => ucwords(strtolower(trim($dataOrder['city']))),
        'observation' => ucfirst(strtolower(trim($dataOrder['observation']))),
      ]);
    } else {

      $stmt = $connection->prepare("SELECT * FROM order_data_delivery WHERE id_order = :id_order AND id_remission = :id_remission");
      $stmt->execute(['id_order' => $dataOrder['id_order'], 'id_remission' => $dataOrder['id_remission']]);
      $rows = $stmt->rowCount();

      if ($rows == 0) {
        $stmt = $connection->prepare("INSERT INTO order_data_delivery (id_order, id_remission, purchase_order, advance_date, advance_value, policy_number, date_delivery, contact_delivery, address_delivery, phone, city, observation) 
                                    VALUES(:id_order, :id_remission, :purchase_order, :advance_date, :advance_value, :policy_number, :date_delivery, :contact_delivery, :address_delivery, :phone, :city, :observation)");
      } else {
        $stmt = $connection->prepare("UPDATE order_data_delivery 
                                    SET purchase_order = :purchase_order, advance_date = :advance_date, advance_value = :advance_value, policy_number = :policy_number, date_delivery = :date_delivery, contact_delivery = :contact_delivery, 
                                          address_delivery = :address_delivery, phone = :phone, city = :city, observation = :observation 
                                    WHERE id_order = :id_order AND id_remission = :id_remission");
      }

      $advance_value = trim($dataOrder['advance_value']);
      $advance_value = str_replace(".", "", $advance_value);

      $stmt->execute([
        'id_order' => $dataOrder['id_order'],
        'id_remission' => $dataOrder['id_remission'],
        'purchase_order' => trim($dataOrder['purchase_order']),
        'advance_date' => trim($dataOrder['advance_date']),
        'advance_value' => $advance_value,
        'policy_number' => trim($dataOrder['policy']),
        'date_delivery' => $dataOrder['date_delivery'],
        'contact_delivery' => ucwords(strtolower(trim($dataOrder['contact_delivery']))),
        'address_delivery' => ucwords(strtolower(trim($dataOrder['address_delivery']))),
        'phone' => $dataOrder['phone'],
        'city' => ucwords(strtolower(trim($dataOrder['city']))),
        'observation' => ucfirst(strtolower(trim($dataOrder['observation']))),
      ]);
    }
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return 1;
  }



  public function cancelOrder($id_order, $observation)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM orders WHERE id_order = :id_order");
    $stmt->execute(['id_order' => $id_order]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("UPDATE orders SET status = :status WHERE id_order = :id_order");
      $stmt->execute(['status' => 0, 'id_order' => $id_order]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

      $stmt = $connection->prepare("INSERT INTO orders_canceled (id_order, observation) VALUES(:id_order, :observation)");
      $stmt->execute(['id_order' => $id_order, 'observation' => $observation]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

      return 1;
    }
  }
}
