<?php

namespace App\Models;

use PDO;

class DBTransaction
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "test";
    private $data;

    public function __construct()
    {
        $conn = "mysql:host=$this->host;dbname=$this->database";
        $this->data = new PDO($conn, $this->user, $this->password);
    }

    public function query($query)
    {
        return $this->data->query($query);
    }

    public function prepare($query)
    {
        return $this->data->prepare($query);
    }
}
