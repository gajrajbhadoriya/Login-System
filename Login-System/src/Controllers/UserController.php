<?php

namespace App\Controllers;

use App\Models\DBTransaction;
use App\Models\User;

class UserController
{
    private $user;
    private $db;

    public function __construct()
    {
        // $this->db = new DBTransaction();
        $this->user = new User($this->db);
    }

    public function register()
    {
        $message = '';
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password === $confirmPassword) {
                $result = $this->user->register($name, $email, $gender, $dob, $password);
                if ($result) {
                    $message = "Registration successful. You can now login.";
                } else {
                    $message = "Registration failed. Please try again.";
                }
            } else {
                $message = "Passwords do not match.";
            }
        }
        require_once '../views/register.php';
    }

    public function login()
    {
        $message = '';
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->user->login($email, $password);
            if ($user) {
                session_start();
            } else {
                $message = "please enter correct Username or Password. please try Again";
            }
        }
    }
}
