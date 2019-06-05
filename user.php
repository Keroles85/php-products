<?php
session_start();

function dbConnect() {
  require 'backend/config.php';
  return $db;
}

// check if user is registerting or loggin in
if (isset($_POST['register_btn'])) {
  register();
} elseif (isset($_POST['login_btn'])) {
  login();
}

function register() {
  $db = dbConnect();
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $sql = "INSERT INTO users (first_name, last_name, email, password, isadmin) VALUES (?, ?, ?, ?, ?)"; //using positional placeholders
  $stmt = $db -> prepare($sql);
  $stmt -> execute([$firstName, $lastName, $email, $password, 0]);
  $inserted = $stmt -> rowCount();
  header('location: confirm.php?action=register&query='.$inserted);
}

function login() {
  $db = dbConnect();
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM users WHERE email = :email AND password = :password"; //using named placeholders
  $stmt = $db -> prepare($sql);
  $stmt -> execute(['email' => $email, 'password' => $password]);
  $queryOk = $stmt -> rowCount();

  if($queryOk > 0) {
    $user = $stmt -> fetch();//get user into associative array
    $_SESSION['user'] = $user;
    header("location: confirm.php?action=Login&query=$queryOk");
  } else {
    echo "Username / Password incorrect";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="css/main_front.css"> <!-- my-style -->
  <title>Furniture Homepage</title>
</head>
<body>

<div class="wrapper">

  <header class="nav_bar"></header>

  <section class="main-content">
    <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger errors">
      <ul>
        <?php foreach($errors as $error): ?>
        <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>
  </section>

</div>

<script src="js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
<script src="js/bootstrap.min.js"></script> <!-- bootstrap -->
<script src="js/front.js"></script>
</body>
</html>