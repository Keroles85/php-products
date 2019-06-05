<?php
session_start();

if(isset($_POST['login_btn'])) {
  login();
}

// include config file
function dbConnect() {
  require 'config.php';
  return $db;
}

function login() {
  $db = dbConnect();
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM users WHERE email = :email AND password = :password"; //using named placeholders
  $stmt = $db -> prepare($sql);
  $stmt -> execute(['email' => $email, 'password' => $password]);
  $queryOk = $stmt -> rowCount();

  //check if query returned any result
  if($queryOk > 0) {
    $user = $stmt -> fetch(PDO::FETCH_ASSOC);//get user into associative array
    //check if user is admin
    if($user['isadmin']) {
      $_SESSION['admin'] = $user;
      header("location: index.php");
    } else {
      echo "You are not authorised to enter this page";
    }
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
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/login-form.css">
  <title>Admin Login</title>
</head>
<body>
  <div class="container">
    <div class="form-container">
      <div class="header">
        <h1>Please login</h1>
      </div>
      <hr>

      <div class="form">
        <form action="" method="post">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" name="login_btn" class="btn btn-primary">Log In</button>
        </form>
      </div>

    </div> <!-- .form-container end -->
  </div> <!-- .container end -->
<script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
</body>
</html>