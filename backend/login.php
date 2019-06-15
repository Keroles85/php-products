<?php
session_start();
include_once dirname(__DIR__) . '/includes/autoload.php';

if (isset($_POST['login_btn'])) {
  login(new User());
}

function login($user) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $user->login($email, $password);
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

            <?php if (!isset($_GET['status'])): ?>
              <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <?php else: ?>
              <input type="text" class="form-control is-invalid" id="email" name="email" aria-describedby="emailHelp" value="<?= $_GET['email'] ?>">
            <?php endif; ?>

          </div>
          <div class="form-group">
            <label for="password">Password</label>

            <?php if (!isset($_GET['status'])): ?>
              <input type="password" class="form-control" id="password" name="password">
            <?php else: ?>
              <input type="password" class="form-control is-invalid" id="password" name="password">
              <div class="invalid-feedback">
                Please Check email/password is correct
              </div>
            <?php endif; ?>

          </div>
          <button type="submit" name="login_btn" class="btn btn-primary">Log In</button>
        </form>
      </div>

    </div> <!-- .form-container end -->
  </div> <!-- .container end -->
<script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
</body>
</html>