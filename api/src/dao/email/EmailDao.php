<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class EmailDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllEmailsByUser($id_user)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM emails WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $process = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("process", array('process' => $process));
        return $process;
    }

    public function insertEmail($dataEmail, $id_user)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            $stmt = $connection->prepare("INSERT INTO emails (tittle, content, id_user) VALUES (:tittle, :content, :id_user)");
            $stmt->execute([
                'tittle'  => $dataEmail['tittle'],
                'content' => $dataEmail['content'],
                'id_user' => $id_user
            ]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }
}
