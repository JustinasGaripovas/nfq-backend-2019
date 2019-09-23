<?php

namespace App\Storage;

use App\Entity\Administration\Enum\VisitationStatus;
use PDO;

class StorageSystem
{
    private function open_database_connection()
    {
        $connection = new PDO($_ENV['DATABASE_PREFIX'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);

        return $connection;
    }

    private function close_database_connection(&$connection)
    {
        $connection = null;
    }

    public function get_visitation_tasks($hasLimit = true, $limit = 10)
    {
        $connection = $this->open_database_connection();

        $sql = "SELECT visitation_task.created_at, visitation_task.id AS visitId, client.name, specialist.name AS specName FROM visitation_task 
            INNER JOIN client ON client.id = visitation_task.user_id
            INNER JOIN specialist ON specialist.id = visitation_task.specialist_id
            WHERE visitation_task.is_active = 1
            ORDER BY visitation_task.created_at DESC";

        if ($hasLimit)
            $sql .= " LIMIT " . $limit;


        $result = $connection->query($sql);

        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return $posts;
    }

    public function get_visitation_tasks_new($hasLimit = true, $limit = 10)
    {
        $connection = $this->open_database_connection();

        $sql = "SELECT visitation_task.created_at, visitation_task.id AS visitId, client.name, specialist.name AS specName FROM visitation_task 
            INNER JOIN client ON client.id = visitation_task.user_id
            INNER JOIN specialist ON specialist.id = visitation_task.specialist_id
            WHERE visitation_task.status = '" . VisitationStatus::NEW . "'
            ORDER BY visitation_task.created_at DESC";


        if ($hasLimit)
            $sql .= " LIMIT " . $limit;


        $result = $connection->query($sql);

        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return $posts;
    }

    public function set_visitation_status($visit_id, $status, $disable = false)
    {
        $connection = $this->open_database_connection();

        //todo: TimeStamp when task is finished

        if ($disable)
            $sql = "UPDATE visitation_task SET visitation_task.status='" . $status . "',visitation_task.is_active=0 WHERE visitation_task.id = " . $visit_id;
        else
            $sql = "UPDATE visitation_task SET visitation_task.status='" . $status . "' WHERE visitation_task.id = " . $visit_id;



        $result = $connection->query($sql);

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'lastId' => null];
    }

    public function add_new_client($data)
    {
        $connection = $this->open_database_connection();

        $username = $data['clientName'];
        $password = $data['clientPassword'];
        $createdAt = $data['createdAt'];
        $updatedAt = $data['updatedAt'];

        $sql = "INSERT INTO client (name, password, created_at, updated_at) VALUES ('" . $username . "','" . $password . "','" . $createdAt->format('Y-m-d H:i:s') . "','" . $updatedAt->format('Y-m-d H:i:s') . "');";

        $result = $connection->query($sql);

        $lastId = $connection->lastInsertId();

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'lastId' => $lastId];
    }

    public function add_new_specialist($data)
    {
        $connection = $this->open_database_connection();

        $username = $data['clientName'];
        $password = $data['clientPassword'];
        $createdAt = $data['createdAt'];
        $updatedAt = $data['updatedAt'];

        $sql = "INSERT INTO specialist (name, password, created_at, updated_at, is_active) VALUES ('" . $username . "','" . $password . "','" . $createdAt->format('Y-m-d H:i:s') . "','" . $updatedAt->format('Y-m-d H:i:s') . "','" . true . "');";

        $result = $connection->query($sql);

        $lastId = $connection->lastInsertId();

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'lastId' => $lastId];
    }

    public function add_new_visitation_task($data)
    {
        $connection = $this->open_database_connection();

        $createdAt = $data['createdAt'];
        $updatedAt = $data['updatedAt'];
        $clientId = $data['clientId'];
        $status = $data['status'];
        $specialistId = $data['specialistId'];

        $sql = "INSERT INTO visitation_task (specialist_id, status, created_at, updated_at, user_id, is_active) VALUES ('" . $specialistId . "','" . $status . "','" . $createdAt->format('Y-m-d H:i:s') . "','" . $updatedAt->format('Y-m-d H:i:s') . "','" . $clientId . "','" . true . "');";

        $result = $connection->query($sql);
        $lastId = $connection->lastInsertId();

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'lastId' => $lastId];
    }

    public function get_user_by_id($user_id)
    {
        $connection = $this->open_database_connection();

        $result = $connection->query("
            SELECT visitation_task.created_at, client.name FROM visitation_task 
            INNER JOIN client ON client.id = visitation_task.user_id
            WHERE client.id = " . $user_id . "
            ORDER BY visitation_task.created_at DESC LIMIT 1");

        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'list' => $posts];
    }

    public function get_specialist()
    {
        $connection = $this->open_database_connection();

        $sql = "SELECT * FROM specialist";

        $result = $connection->query($sql);

        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'list' => $posts];
    }

    public function get_client($user_name)
    {
        $connection = $this->open_database_connection();


        $sql = "SELECT * FROM client WHERE client.name = '" . $user_name . "'";


        $result = $connection->query($sql);

        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return ['error' => $result->errorCode(), 'list' => $posts];
    }
}
