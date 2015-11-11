<?php
include_once('../../../db.config');
class Transporter
{
    public function getConnection()
    {
        // Create connection
        $connection = new mysqli(DB_ENDPOINT, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check connection
        if ($connection->connect_error) {
            echo("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }
}

