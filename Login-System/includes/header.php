<!DOCTYPE html>
<html>
   <head>
      <title>Welcome Page</title>
   </head>
   <body>
      <nav>
         <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="./views/login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <?php endif; ?>
         </ul>
      </nav>
   </body>
</html>