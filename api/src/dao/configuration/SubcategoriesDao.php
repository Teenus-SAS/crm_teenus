<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SubcategoriesDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM subcategories c INNER JOIN subcategories s ON c.id_category = s.id_category");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $categories = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Categotias Obtenidas", array('categorias' => $categories));
    return $categories;
  }

  public function findAllSubcategories()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM subcategories");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $categories = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Categorias Obtenidas", array('categorias' => $categories));
    return $categories;
  }

  public function findOne($idUser)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM budgets WHERE id_user = :idUser");
    $stmt->execute(['idUser' => $idUser]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $budgets = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("presupuestos Obtenidos", array('presupuestos' => $budgets));
    return $budgets;
  }

  public function findSubcategoryByID($dataCategory)
  {
    $connection = Connection::getInstance()->getConnection();
    $sql = "SELECT * FROM subcategories WHERE subcategory = :subcategory";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['subcategory' => $dataCategory['subcategory']]);
    $rows = $stmt->rowCount();
    return $rows;
  }

  public function insertCategory($dataCategory)
  {
    try {
      $connection = Connection::getInstance()->getConnection();
      $sql = "INSERT INTO subcategories (subcategory, id_category) VALUES(:subcategory, :id_category)";
      $stmt = $connection->prepare($sql);
      $stmt->execute([
        'subcategory' => ucfirst(strtolower(trim($dataCategory['subcategory']))),
        'id_category' => $dataCategory['category'],
      ]);

      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function updateSubcategory($dataCategory)
  {
    $connection = Connection::getInstance()->getConnection();
    $sql = "UPDATE subcategories SET category = :category WHERE id_category = :id_category";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
      'id_category' => $dataCategory['id_category'],
      'category' => ucwords(strtolower(trim($dataCategory['category']))),
    ]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
  }


  public function saveSubcategory($dataCategory)
  {
    if (!empty($dataCategory['id_subcategory'])) {
      $this->updateSubcategory($dataCategory);
      return 2;
    } else {
      $rows = $this->findSubcategoryByID($dataCategory);
      if ($rows > 0) {
        $this->updateSubcategory($dataCategory);
        return 2;
      } else {
        $this->insertCategory($dataCategory);
        return 1;
      }
    }
  }

  public function deleteSubcategory($dataCategory)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM categories WHERE id_category = :id_category");
    $stmt->execute(['id_category' => $dataCategory]);
    $rows = $stmt->rowCount();

    if ($rows > 0) {
      $stmt = $connection->prepare("DELETE FROM categories WHERE id_category = :id_category");
      $stmt->execute(['id_category' => $dataCategory]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
  }
}
