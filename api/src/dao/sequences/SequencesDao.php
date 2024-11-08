<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class SequencesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllSequences()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM sequences");
        $stmt->execute();

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $sequence = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $sequence;
    }

    public function findSequence($dataSequence)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM sequences WHERE name_sequence = :name_sequence");
            $stmt->execute(['name_sequence' => $dataSequence['nameSequence']]);

            $sequence = $stmt->fetch($connection::FETCH_ASSOC);
            return $sequence;
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function insertSequence($dataSequence)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            $stmt = $connection->prepare("INSERT INTO sequences (name_sequence) VALUES (:name_sequence)");
            $stmt->execute([
                'name_sequence'  => $dataSequence['nameSequence']
            ]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }

    public function updateSequence($dataSequence)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            $stmt = $connection->prepare("UPDATE sequences SET name_sequence = :name_sequence WHERE id_sequence = :id_sequence");
            $stmt->execute([
                'id_sequence' => $dataSequence['idSequence'],
                'name_sequence'  => $dataSequence['nameSequence']
            ]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }

    public function deleteSequence($id_sequence)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM sequences WHERE id_sequence = :id_sequence");
            $stmt->execute(['id_sequence' => $id_sequence]);
            $rows = $stmt->rowCount();

            if ($rows > 0) {
                $stmt = $connection->prepare("DELETE FROM sequences WHERE id_sequence = :id_sequence");
                $stmt->execute(['id_sequence' => $id_sequence]);
                $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
            }
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }
}
