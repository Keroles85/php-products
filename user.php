<?php
session_start();

include_once __DIR__ . '/includes/autoload.php';

// check if user is registering or logging in
if (isset($_POST['register_btn'])) {
  register(new User());
} elseif (isset($_POST['login_btn'])) {
  login(new User());
}

function register($user) {
  $data = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => md5($_POST['password']),
    'isadmin' => 0
  ];

  $stmt = $user->create($data);
  header('location: confirm.php?action=register&query='.$stmt);
}

function login($user) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cookie = isset($_POST[''])? 1 : 0;
  $user->login($email, $password, $cookie);
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
  <section class="main-content"></section>

</div>

<script src="js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
<script src="js/bootstrap.min.js"></script> <!-- bootstrap -->
<script src="js/front.js"></script>
</body>
</html>