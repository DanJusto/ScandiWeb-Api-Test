<?php

namespace Scandiweb\Test\Infra;

use PDO;
use PDOException;

class Connection 
{
    public static function createConnection(): PDO
    {
        $servername = 'localhost';
        $username = 'scandiweb';
        $password = 'scandiweb';

        try {
            $db = new PDO("mysql:host=$servername;dbname=scandiweb_db", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $db;
    }
}