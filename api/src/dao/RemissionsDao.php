<?php

namespace crmproyecformas\dao;

use crmproyecformas\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class RemissionsDao
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
    $rol = $_SESSION['rol'];
    $connection = Connection::getInstance()->getConnection();

    if ($rol == 3) {
      $stmt = $connection->prepare("SELECT r.id_remission, r.date_register, r.id_order, c.company_name, CONCAT (ct.firstname, ' ', ct.lastname) AS contact, b.name_business
                                    FROM remissions r
                                    INNER JOIN orders o ON o.id_order = r.id_order 
                                    INNER JOIN quotes q ON q.id_quote = o.id_quote
                                    INNER JOIN companies c ON c.id_company = q.id_company
                                    INNER JOIN contacts ct ON ct.id_contact = q.id_contact
                                    INNER JOIN business b ON b.id_business = q.id_business
                                    WHERE r.status > 0 ORDER BY `r`.`id_remission` DESC;");
      $stmt->execute();
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $remissions = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get remissions", array('remissions' => $remissions));
    return $remissions;
  }

  public function findOrderById($id_order)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT rp.id_remission, o.id_order, CONCAT(c.firstname, ' ',c.lastname) AS contact, cp.company_name, cp.address, cp.nit, 
                                      c.email AS email_customer, r.date_register, b.name_business, qp.id_quote_product, p.reference, p.product, 
                                      p.description, qp.quantity, p.img, rp.quantity_delivered,
                                      CONCAT(u.firstname, ' ', u.lastname) AS seller, u.email,
                                      odd.purchase_order, odd.date_delivery, odd.contact_delivery, odd.address_delivery, odd.phone, odd.city, 
                                      CONCAT(u.firstname, ' ',u.lastname) AS asesor  
                                  FROM remissions_products rp 
                                  INNER JOIN remissions r ON r.id_remission = rp.id_remission
                                  INNER JOIN orders o ON o.id_order = r.id_order
                                  INNER JOIN quotes q ON o.id_quote = q.id_quote 
                                  INNER JOIN quotes_products qp ON rp.id_quote_product = qp.id_quote_product
                                  INNER JOIN products p ON p.id_product = qp.id_product
                                  INNER JOIN order_data_delivery odd ON odd.id_order = o.id_order 
                                  INNER JOIN companies cp ON cp.id_company = q.id_company 
                                  INNER JOIN contacts c ON c.id_contact = q.id_contact
                                  INNER JOIN business b ON b.id_business = q.id_business
                                  INNER JOIN users u ON u.id_user = cp.created_by 
                                  WHERE o.id_order = :id_order
                                  GROUP BY o.id_order");
    $stmt->execute(['id_order' => $id_order]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $remission = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get remission", array('remission' => $remission));
    return $remission;
  }

  public function findRemissionById($id_remission)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT rp.id_remission, p.img, p.reference, p.product, p.description, rp.quantity_delivered
                                  FROM remissions_products rp
                                  INNER JOIN products p ON p.id_product = rp.id_quote_product
                                  WHERE rp.id_remission = :id_remission;");
    $stmt->execute(['id_remission' => $id_remission]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $remission = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get remission", array('remission' => $remission));
    return $remission;
  }


  public function findDataDeliveryRemissionById($id_order, $id_remission)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT odd.purchase_order, odd.date_delivery, odd.contact_delivery, odd.address_delivery, odd.phone, odd.city
                                  FROM order_data_delivery odd
                                  WHERE odd.id_order = :id_order AND odd.id_remission = :id_remission");
    $stmt->execute(['id_order' => $id_order, 'id_remission' => $id_remission]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $dataDeliveryRemission = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get datadataDeliveryRemission", array('dataDeliveryRemission' => $dataDeliveryRemission));
    return $dataDeliveryRemission;
  }

  public function findRemissionByIdOrder($id_order)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM remissions WHERE id_order = :id_order AND status > 0;");
    $stmt->execute(['id_order' => $id_order]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $remission = $stmt->fetch($connection::FETCH_ASSOC);
    $this->logger->notice("get remission", array('remission' => $remission));
    return $remission;
  }

  public function saveRemission($dataRemission)
  {
    $connection = Connection::getInstance()->getConnection();

    /* Crea la remision */

    $stmt = $connection->prepare("INSERT INTO remissions (id_order) VALUES(:id_order)");
    $stmt->execute(['id_order' => $dataRemission['id_order']]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

    /* Actualiza la cantidad total de los productos */

    $this->updateProductsRemission($dataRemission['products']);

    /* Obtiene el Id de la remision ingresada */

    $stmt = $connection->prepare("SELECT MAX(id_remission) AS id FROM remissions");
    $stmt->execute();
    $id_remission = $stmt->fetch($connection::FETCH_ASSOC);

    $this->insertProductsRemission($dataRemission['products'], $id_remission);
    return 1;
  }

  public function loadProductsRemission($id)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT qp.id_quote_product, r.id_order, r.id_remission, qp.reference, qp.product, qp.description_product, qp.quantity 
                                  FROM remissions r 
                                  INNER JOIN orders o ON o.id_order = r.id_order 
                                  INNER JOIN quotes_products qp ON qp.id_quote = o.id_quote 
                                  WHERE r.id_remission = :id_remission AND r.status = 1;");
    $stmt->execute(['id_remission' => $id]);
    $productsRemission = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get remission", array('remission' => $productsRemission));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return $productsRemission;
  }

  public function updateProductsRemission($productsRemission)
  {
    $connection = Connection::getInstance()->getConnection();

    /* Obtener la cantidad entregada */

    foreach ($productsRemission as $product) {
      $stmt = $connection->prepare("SELECT * FROM quotes_products WHERE id_quote_product = :id_quote_product;");
      $stmt->execute(['id_quote_product' => $product['id_quote_product']]);
      $productsRemissionBD = $stmt->fetchAll($connection::FETCH_ASSOC);

      /* Actualizar cantidad entregada */

      $stmt = $connection->prepare("UPDATE quotes_products SET delivered = :quantity WHERE id_quote_product = :id_quote_product;");
      $stmt->execute([
        'quantity' => $product['deliverQuantity'] + $productsRemissionBD[0]['delivered'],
        'id_quote_product' => $product['id_quote_product']
      ]);

      $this->logger->notice("get remission", array('remission' => $product));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }

  public function insertProductsRemission($productsRemission, $id_remission)
  {
    $connection = Connection::getInstance()->getConnection();

    /* Ingresar productos de la remisión */

    foreach ($productsRemission as $product) {
      $stmt = $connection->prepare("INSERT INTO remissions_products(id_remission, id_quote_product, quantity_delivered) VALUES (:id_remission, :id_product, :quantity_delivered)");
      $stmt->execute(['id_remission' => $id_remission['id'], 'id_product' => $product['id_quote_product'], 'quantity_delivered' => $product['deliverQuantity']]);

      $this->logger->notice("get remission", array('remission' => $product));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }


  public function cancelRemission($id_order, $observation)
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
