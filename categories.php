<?php

include_once __DIR__ . '/includes/autoload.php';

function getCategories($category) {
  return $category->readAll();
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
  <link rel="stylesheet" href="style/css/categories.css"> <!-- my-style -->
</head>
<body>
<div class="wrapper">

  <header class="nav_bar"></header>

  <section class="main-section">
    <h1 style="margin: 15px;">Choose category...</h1>

    <!-- get categories items -->
    <?php 
    $categories = getCategories(new Category());
    foreach($categories as $category): 
    ?>
    <a href="products.php?cat_id=<?= $category['id'] ?>">
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h2><?= $category['name'] ?></h2>
          <p class="lead"><?= $category['description'] ?></p>
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