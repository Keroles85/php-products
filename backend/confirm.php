<?php

$action = $_GET['action'];
$type = $_GET['type'];
$queryOk = $_GET['query'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../css/main.css"> <!-- my-style -->
  <title>Confirmation page</title>
  <style>
    .alert {
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <nav id="navbar">
      <ul>
        <li><a href="index.php" class="nav-link" id="home">Home</a></li>
        <li><a href="addcategory.php" class="nav-link" id="addcategory">Add Category</a></li>
        <li><a href="addproduct.php" class="nav-link" id="addproduct">Add Products</a></li>
        <li><a href="carousel.php" class="nav-link" id="carousel">Manage Carousel</a></li>
      </ul>
    </nav>

    <section class="main-section">
      <?php if($queryOk > 0): ?>
        <div class="alert alert-success" role="alert">
          <?= "$action was ${type}ed Succesfully"; ?>
        </div>
      <?php else: ?>
        <div class="alert alert-warning" role="alert">
          <?= "There was error ${type}ing $action!"; ?>
        </div>
      <?php endif; ?>
    </section>
  </div>
  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script>
    $(".btn").click(function() {
      window.location.replace("http://localhost/Assignment/php-products/backend/");
    });
  </script>
</body>
</html>