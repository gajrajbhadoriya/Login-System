<?php

namespace App\Models;

use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new DBTransaction();
    }

    public function register($name, $email, $gender, $dob, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO register(name, email, gender, dob, password) VALUES (:name, :email, :gender, :dob, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':password', $hash);
        return $stmt->execute();
        // var_dump($stmt->execute());
        // exit;
    }

    public function login($email, $password)
    {
        // $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM register WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // if (crypt($email, $user) === $hash) {
        //     echo "The password is correct";
        // }
        if (password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
