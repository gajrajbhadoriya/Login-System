<?php

include '../views/includes/header.php';

use App\Controllers\UserController;

$userController = new UserController();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$message = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $userController->login($email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $message = "Invalid email or password.";
    }
}

require_once '../includes/header.php';
?>

<h1>Login</h1>

<form method="post">
   <div>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
   </div>
   <div>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
   </div>
   <button type="submit" name="submit">Login</button>
</form>

<p><?php echo $message; ?></p>

<?php require_once '../includes/footer.php'; ?>