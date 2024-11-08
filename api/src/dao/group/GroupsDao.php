<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class GroupsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllGroups($id_user)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT 
                                          -- Columnas 
                                            g.id_group, 
                                            g.name_group, 
                                            u.id_user, 
                                            u.firstname, 
                                            u.lastname, 
                                            u.email
                                          FROM groups g
                                            INNER JOIN users u ON u.id_user = g.id_user
                                          WHERE g.id_user = :id_user");
            $stmt->execute(['id_user' => $id_user]);

            $groups = $stmt->fetchAll($connection::FETCH_ASSOC);
            return $groups;
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function findGroup($dataGroup)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM groups WHERE name_group = :name_group");
            $stmt->execute(['name_group' => $dataGroup['group']]);

            $groups = $stmt->fetch($connection::FETCH_ASSOC);
            return $groups;
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function insertGroup($dataGroup, $id_user)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("INSERT INTO groups (name_group, id_user) VALUES (:name_group, :id_user)");
            $stmt->execute([
                'name_group' => trim($dataGroup['group']),
                'id_user' => $id_user
            ]);
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function updateGroup($dataGroup)
    {
        try {
            $connection = Connection::getInstance()->getConnection();
            $stmt = $connection->prepare("UPDATE groups SET name_group = :name_group WHERE id_group = :id_group");
            $stmt->execute([
                'id_group' => $dataGroup['idGroup'],
                'name_group' => trim($dataGroup['group'])
            ]);
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }

    public function deleteGroup($id_group)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM groups WHERE id_group = :id_group");
            $stmt->execute(['id_group' => $id_group]);
            $rows = $stmt->rowCount();

            if ($rows > 0) {
                $stmt = $connection->prepare("DELETE FROM groups WHERE id_group = :id_group");
                $stmt->execute(['id_group' => $id_group]);
                $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
            }
        } catch (\Exception $e) {
            return ['info' => true, 'message' => $e->getMessage()];
        }
    }
}
