<?php

namespace App\Storage;

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

    public function get_visitation_tasks($limit = 10)
    {
        $connection = $this->open_database_connection();

        $result = $connection->query("
            SELECT visitation_task.created_at, client.name FROM visitation_task 
            INNER JOIN client ON client.id = visitation_task.user_id
            ORDER BY visitation_task.created_at DESC LIMIT " . $limit);


        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return $posts;
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

        return ['error'=>$result->errorCode(), 'lastId' => $lastId];
    }

    public function add_new_visitation_task($data)
    {
        $connection = $this->open_database_connection();

        $createdAt = $data['createdAt'];
        $updatedAt = $data['updatedAt'];
        $clientId = $data['clientId'];

        $sql = "INSERT INTO visitation_task (created_at, updated_at, user_id) VALUES ('" . $createdAt->format('Y-m-d H:i:s') . "','" . $updatedAt->format('Y-m-d H:i:s') . "','" . $clientId . "');";

        $result = $connection->query($sql);
        $lastId = $connection->lastInsertId();

        $this->close_database_connection($connection);

        return ['error'=>$result->errorCode(), 'lastId' => $lastId];
    }

    public function get_user_by_id($user_id)
    {
        $connection = $this->open_database_connection();

        $result = $connection->query("
            SELECT visitation_task.created_at, client.name FROM visitation_task 
            INNER JOIN client ON client.id = visitation_task.user_id
            WHERE client.id = ". $user_id ."
            ORDER BY visitation_task.created_at DESC LIMIT 1");

        $posts = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        $this->close_database_connection($connection);

        return ['error'=>$result->errorCode(), 'list'=>$posts];
    }
}
