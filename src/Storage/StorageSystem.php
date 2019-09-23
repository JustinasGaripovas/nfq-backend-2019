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

    public function get_all_visitation_tasks()
    {
        $connection = $this->open_database_connection();

        $result = $connection->query('SELECT * FROM visitation_task');

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

        $this->close_database_connection($connection);

        return $result->errorCode();
    }
}
