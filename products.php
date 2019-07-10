<?php

include_once __DIR__ . '/includes/autoload.php';

$cat_id = isset($_GET['cat_id'])? $_GET['cat_id'] : die("ERROR: missing ID.") ;

function getProducts($product, $cat_id) {
  return $product->readAllByCategory($cat_id);
}

function getCategoryName($category, $cat_id) {
  foreach ($category->readCategory($cat_id) as $cols) {
    return $cols['name'];
  };
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
  <link rel="stylesheet" href="style/css/products.css"> <!-- my-style -->
</head>
<body>
<div class="wrapper">

  <header class="nav_bar"></header>

  <section class="main-section">
    <h1>
      <?php
        echo getCategoryName(new Category(), $cat_id);
      ?>
    </h1>

    <!-- show all products -->
    <?php
    $products = getProducts(new Product() ,$cat_id);
    foreach($products as $product): 
    ?>
    <a href="product.php?id=<?= $product['id'] ?>">
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?= $product['image_url'] ?>" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $product['product_name'] ?></h5>
              <p class="card-text">
                <?= $product['description'] ?>
              </p>
              <p class="card-text"><small class="text-muted"><?= $product['price'] ?></small></p>
            </div>
          </div>
        </div>
      </div>
    </a>
    <?php endforeach; ?>
    
  </section>

</div>

<script src="js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
<script src="js/bootstrap.min.js"></script> <!-- bootstrap -->
<script src="js/front.js"></script>
</body>
</html>