<?php
include_once __DIR__ . '/includes/autoload.php';

/*$file = __DIR__;// . "/classes/Product.php";
echo $file;*/

function getCarousel($carousel) {
  return $carousel->readVisible();
}

function getFeatured($product) {
  return $product->getFeatured();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="style/css/main_front.css"> <!-- my-style -->
  <title>Furniture Homepage</title>
</head>
<body>

<div class="wrapper">

  <!-- header will be loaded throught jQuery -->
  <header class="nav_bar"></header>

  <section class="main-carousel">

    <div id="mainCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        
        <!-- php loop for slide buttons -->
        <?php
          $count = 0; 
          $items = getCarousel(new Carousel());
          foreach($items as $item): 
        ?>

        <li data-target="#mainCarousel" data-slide-to="<?= $count ?>" class="<?= $item['active']? 'active' : '' ?>"></li>

        <?php 
          $count++; 
          endforeach;
        ?>

      </ol>
      <div class="carousel-inner">

      <!-- php loop for slide images -->
      <?php 
        $images = getCarousel(new Carousel());
        foreach($images as $image): 
      ?>
        <div class="carousel-item <?= $image['active']? 'active' : '' ?>">
          <img src="<?= $image['img_url'] ?>" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5><?= $image['title'] ?></h5>
            <p><?= $image['caption'] ?></p>
          </div>
        </div>

      <?php endforeach; ?>

      </div>

      <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div> <!-- .carousel -->

  </section>

  <section class="main-content">
    <div class="items">

      <!-- show featured items from database -->
      <?php
        $featured = getFeatured(new Product());
        foreach($featured as $feat):
      ?>
      <div class="card" style="width: 21rem;">
        <img src="<?= $feat['image_url'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?= $feat['name'] ?></h5>
          <p class="card-text"><?= substr($feat['description'], 0, 50) ?>...</p>
          <a href="product.php?id=<?= $feat['id'] ?>" class="btn btn-light">Learn more</a>
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