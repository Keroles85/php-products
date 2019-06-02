<?php

$queryOK = $_GET['query'];
$action = $_GET['action'];

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
        <?php if($queryOK > 0): ?>
            <div class="alert alert-success" role="alert">
                <?= "$action was successfully"; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                <?= "$action was not successful!"; ?>
            </div>
        <?php endif; ?>
    </section>

</div>

<script src="js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
<script src="js/bootstrap.min.js"></script> <!-- bootstrap -->
<script src="js/front.js"></script>
</body>
</html>