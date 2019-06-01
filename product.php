<?php
require_once 'backend/config.php';

$id = $_GET['id'];
getProduct($id);

function getProduct($id) {
  global $db, $product;
  $sql = "select products.*, images.image_url from products inner join images
    on images.product_id = products.id where products.id = $id";
  $product = $db -> query($sql);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Products Home Page</title>
  <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="css/product.css"> <!-- my-style -->
</head>
<body>
<div class="wrapper">

  <header class="nav_bar"></header>

  <section class="main-section">
  <div class="card">

    <?php foreach($product as $items): ?>
    <img src="<?= $items['image_url'] ?>" class="card-img-top" alt="Product Image">
    <div class="card-body">
      <h5 class="card-title"><?= $items['name'] ?></h5>
      <div class="space">Price: <b><?= $items['price'] ?></b></div>
      <div class="card-text space"><?= $items['description'] ?></div>
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