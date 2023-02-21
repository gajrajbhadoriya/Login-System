<?php
include '../views/includes/header.php';

use App\Controllers\UserController;

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$message = '';

if (isset($_POST['submit'])) {
    $userController = new UserController();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password == $confirm_password) {
        $result = $userController->register($name, $email, $gender, $dob, $password);
        // var_dump($result);
        if ($result) {
            $message = "Registration successful. You can now login.";
        } else {
            $message = "Registration failed. Please try again.";
        }
    } else {
        $message = "Passwords do not match.";
    }
}

require_once '../includes/header.php';
?>
<html>
    <head>
        <title>
            Register-Page
        </title>
    </head>
    <body>
<h1>Register</h1>
<form method="post">
   <div>
      <label for="name">Name:</label>
      <input type="text" name="name" id="username" required>
   </div>
   <div>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
   </div>
   <div>
      <label for="gender">Gender:</label>
      <input type="text" name="gender" id="gender" required>
   </div>
   <div>
      <label for="dob">DoB:</label>
      <input type="date" name="dob" id="dob" required>
   </div>
   <div>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
   </div>
   <div>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" id="confirm_password" required>
   </div>
   <button type="submit" name="submit">Register</button>
</form>
<p><?php echo $message; ?></p>
    </body>
</html>