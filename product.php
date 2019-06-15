<?php

include_once __DIR__ . '/includes/autoload.php';

$product_id = $_GET['id'];

function getProduct($product, $product_id) {
  return $product->readByID($product_id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Products Home Page</title>
  <link rel="stylesheet" href="style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="style/css/product.css"> <!-- my-style -->
</head>
<body>
<div class="wrapper">

  <header class="nav_bar"></header>

  <section class="main-section">
  <div class="card">

    <?php 
    $product = getProduct(new Product(), $product_id);
    foreach($product as $details): 
    ?>
    <img src="<?= $details['image_url'] ?>" class="card-img-top" alt="Product Image">
    <div class="card-body">
      <h5 class="card-title"><?= $details['name'] ?></h5>
      <div class="space">Price: <b><?= $details['price'] ?></b></div>
      <div class="card-text space"><?= $details['description'] ?></div>
      <div class="space">
        <button class="btn btn-primary">Add to cart</button>
        <button class="btn btn-secondary">Save to list</button>
      </div>
      
    </div>
    <?php endforeach; ?>

  </div>
    
  </section>
</div>

<script src="js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
<script src="js/bootstrap.min.js"></script> <!-- bootstrap -->
<script src="js/front.js"></script>
</body>
</html>