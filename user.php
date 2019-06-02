<?php
session_start();
require_once 'backend/config.php';

if (isset($_POST['register_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $errors = [];

    if($email == '') {
        $errors[] = 'Email required';
    } else if (!strpos($email, '@')) {
        $errors[] = 'Please enter valid email';
    }

    if($password == '') {
        $errors[] = "Password required";
    } else if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if($address == '') {
        $errors[] = 'Address required';
    }

    if(count($errors) == 0) {
        $password = md5($password);
        $sql = "insert into users (email, password, address) values (?, ?, ?)";
        $stmt = $db -> prepare($sql);
        $stmt -> execute([$email, $password, $address]);
        $queryOk = $stmt -> rowCount();
        //var_dump($stmt);
        header('location: confirm.php?action=Register&query='. $queryOk);
    }

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