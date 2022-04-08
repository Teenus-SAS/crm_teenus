<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class QuotesDao
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
      $stmt = $connection->prepare("SELECT q.id_quote, CONCAT(u.firstname, ' ' , u.lastname) AS asesor, CONCAT(c.firstname, ' ' , c.lastname) AS contact, 
                                    cp.company_name, b.name_business, SUM((qp.quantity * qp.price) * (1 - (qp.discount/100))) AS price, q.date_register, o.status 
                                    FROM quotes q 
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                    INNER JOIN companies cp ON cp.id_company = c.id_company 
                                    INNER JOIN business b ON b.id_business = q.id_business 
                                    INNER JOIN quotes_products qp ON qp.id_quote = q.id_quote
                                    LEFT JOIN orders o ON o.id_quote = q.id_quote
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    WHERE cp.created_by = :id_user
                                    GROUP BY qp.id_quote
                                    ORDER BY `q`.`id_quote` DESC;");
      $stmt->execute(['id_user' => $id_user]);
    } else if ($rol == 1) {
      $stmt = $connection->prepare("SELECT q.id_quote, CONCAT(u.firstname, ' ' , u.lastname) AS asesor, CONCAT(c.firstname, ' ' , c.lastname) AS contact, 
                                    cp.company_name, b.name_business, SUM((qp.quantity * qp.price) * (1 - (qp.discount/100))) AS price, q.date_register, o.status 
                                    FROM quotes q 
                                    INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                    INNER JOIN companies cp ON cp.id_company = c.id_company 
                                    INNER JOIN business b ON b.id_business = q.id_business 
                                    INNER JOIN quotes_products qp ON qp.id_quote = q.id_quote
                                    LEFT JOIN orders o ON o.id_quote = q.id_quote
                                    INNER JOIN users u ON u.id_user = cp.created_by
                                    GROUP BY qp.id_quote
                                    ORDER BY `q`.`id_quote` DESC;");
      $stmt->execute();
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $quotes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get quotes", array('quotes' => $quotes));
    return $quotes;
  }

  public function saveQuote($dataQuote)
  {
    $connection = Connection::getInstance()->getConnection();

    if (!empty($dataQuote['id_quote'])) {

      /* Busca un pedido activo */

      $stmt = $connection->prepare("SELECT * FROM orders WHERE id_quote = :id_quote AND status > 0");
      $stmt->execute(['id_quote' => $dataQuote['id_quote']]);
      $rows = $stmt->rowCount();

      if ($rows == 0) {

        /* Actualiza la cotizacion */

        $stmt = $connection->prepare("UPDATE quotes SET id_company = :id_company, id_contact = :id_contact, id_business = :id_business 
                                      WHERE id_quote  = :id_quote");
        $stmt->execute([
          'id_quote' => $dataQuote['id_quote'],
          'id_company' => $dataQuote['company'],
          'id_contact' => $dataQuote['contact'],
          'id_business' => $dataQuote['business'],
        ]);

        /* Actualiza los datos comerciales */

        $stmt = $connection->prepare("UPDATE quotes_commercial_terms 
                                      SET id_quote = :id_quote, id_payment_method = :id_payment_method, validity = :validity, guarantee = :guarantee, delivery_date = :delivery_date 
                                      WHERE id_quote  = :id_quote");
        $stmt->execute([
          'id_quote' => $dataQuote['id_quote'],
          'id_payment_method' => $dataQuote['paymentMethods'],
          'validity' => ucwords(strtolower(trim($dataQuote['time_quote']))),
          'guarantee' => ucwords(strtolower(trim($dataQuote['guarantee']))),
          'delivery_date' => ucwords(strtolower(trim($dataQuote['delivery_date']))),
        ]);

        /* Elimina todos los productos de la cotizacion */

        $stmt = $connection->prepare("DELETE FROM quotes_products WHERE id_quote = :id_quote");
        $stmt->execute(['id_quote' => $dataQuote['id_quote']]);

        /* Carga todos los productos de la cotizacion */

        foreach ($dataQuote['products'] as $product) {
          $stmt = $connection->prepare("INSERT INTO quotes_products (id_quote, reference, product, description_product, img, quantity, price, discount) 
                                        VALUES(:id_quote, :reference, :product, :description_product, :img, :quantity, :price, :discount)");

          $stmt->execute([
            'id_quote' => $dataQuote['id_quote'],
            'reference' => $product['reference'],
            'product' => $product['product'],
            'description_product' => ucfirst(strtolower(trim($product['description']))),
            'img' => $product['img'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'discount' => $product['discount'],

          ]);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return 2;
      } else {
        return 3;
      }
    } else {

      /* Ingresa los valores de empresa, contacto y proyecto */

      $stmt = $connection->prepare("INSERT INTO quotes (id_company, id_contact, id_business) 
                                    VALUES(:id_company,:id_contact, :id_business)");
      $stmt->execute([
        'id_company' => $dataQuote['company'],
        'id_contact' => $dataQuote['contact'],
        'id_business' => $dataQuote['business'],
      ]);

      /* Seleccionar el ultimo numero de la cotizacion */

      $stmt = $connection->prepare("SELECT MAX(id_quote) AS id FROM quotes");
      $stmt->execute();
      $id_quote = $stmt->fetch($connection::FETCH_ASSOC);

      /* Ingresa las condiciones comerciales */

      $stmt = $connection->prepare("INSERT INTO quotes_commercial_terms (id_quote, id_payment_method, validity, guarantee, delivery_date) 
                                    VALUES(:id_quote, :id_payment_method, :validity, :guarantee, :delivery_date)");
      $stmt->execute([
        'id_quote' => $id_quote['id'],
        'id_payment_method' => $dataQuote['paymentMethods'],
        'validity' => ucwords(strtolower(trim($dataQuote['time_quote']))),
        'guarantee' => ucwords(strtolower(trim($dataQuote['guarantee']))),
        'delivery_date' => ucwords(strtolower(trim($dataQuote['delivery_date']))),
      ]);

      /* Ingresa los productos */

      foreach ($dataQuote['products'] as $product) {

        /* Busca el producto */
        $stmt = $connection->prepare("SELECT * FROM products WHERE reference = :reference");
        $stmt->execute(['reference' => trim($product['reference'])]);
        $rows = $stmt->rowCount();

        if ($rows == 0) {
          $stmt = $connection->prepare("INSERT INTO products(reference, product, description, img) VALUES(:reference, :product, :description, :img)");
          $stmt->execute([
            'reference' => trim($product['reference']),
            'product' => ucfirst(strtolower(trim($product['product']))),
            'description' => ucfirst(strtolower(trim($product['description']))),
            'img' => $product['img'],
          ]);
        }
      }

      /* Ingresa el detalle de los productos para la cotizacion */

      foreach ($dataQuote['products'] as $dataProduct) {

        /* Busca el id de los productos */

        $stmt = $connection->prepare("SELECT * FROM products WHERE reference = :reference");
        $stmt->execute(['reference' => trim($dataProduct['reference'])]);
        $product = $stmt->fetch($connection::FETCH_ASSOC);

        /* Inserta detalle del producto */

        $stmt = $connection->prepare("INSERT INTO quotes_products (id_quote, id_product, quantity, price, discount) 
                                      VALUES(:id_quote, :id_product, :quantity, :price, :discount)");
        $stmt->execute([
          'id_quote' => $id_quote['id'],
          'id_product' => $product['id_product'],
          'quantity' => $dataProduct['quantity'],
          'price' => $dataProduct['price'],
          'discount' => $dataProduct['discount'],

        ]);
      }
    }
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return 1;
  }

  public function findQuoteById($id_quote)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT CONCAT(c.firstname, ' ',c.lastname) AS contact, cp.nit, cp.company_name, cp.address, c.email AS email_customer, q.id_quote, 
                                          q.date_register, q.id_business, b.name_business, qct.id_quote, pm.method, qct.validity, qct.guarantee, qct.delivery_date, 
                                          p.reference, p.product, p.description, qp.quantity, qp.price, p.img, qp.discount,
                                          CONCAT(u.firstname, ' ', u.lastname) AS seller, u.email AS emailSeller, u.signature, u.cellphone, u.position, q.date_register 
                                  FROM quotes q 
                                  INNER JOIN quotes_products qp ON q.id_quote = qp.id_quote
                                  INNER JOIN products p ON p.id_product = qp.id_product
                                  INNER JOIN companies cp ON cp.id_company = q.id_company INNER JOIN contacts c ON c.id_contact = q.id_contact 
                                  INNER JOIN business b ON b.id_business = q.id_business
                                  INNER JOIN quotes_commercial_terms qct ON qct.id_quote = q.id_quote
                                  INNER JOIN payment_methods pm ON pm.id_method = qct.id_payment_method
                                  INNER JOIN users u ON u.id_user = cp.created_by WHERE q.id_quote = :id_quote;");
    $stmt->execute(['id_quote' => $id_quote]);

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $quotes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("get quotes", array('quotes' => $quotes));
    return $quotes;
  }


  public function deleteQuote($dataUser)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    $rows = $stmt->rowCount();

    if ($rows > 1) {
      $stmt = $connection->prepare("DELETE FROM users WHERE id_user = :id");
      $stmt->execute(['id' => $dataUser['idUser']]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }


  public function findConditions()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM `quotes_commercial_terms`");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $conditions = $stmt->fetch($connection::FETCH_ASSOC);
    $this->logger->notice("conditions get", array('conditions' => $conditions));
    return $conditions;
  }
}
