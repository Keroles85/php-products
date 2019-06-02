<?php
session_start();

function dbConnect() {
  require 'backend/config.php';
  return $db;
}

if (isset($_POST['register_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $errors = [];
} elseif (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "select * from users where email = ? and password = ?";
    $result = $db -> prepare($sql);
    $result -> execute([$email, $password]);

    if($result -> rowCount() > 0) {
        $_SESSION['user'] = $user;
        $user = $result -> fetch(PDO::FETCH_ASSOC);//get user into associative array
        header("location: index.php");
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