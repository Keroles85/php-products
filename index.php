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
    </div> <!-- .carousel close -->

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

    </div> <!-- .items close -->
  </section>

  <!-- feedback section   -->
  <section class="feedback">
    <div class="jumbotron">
      <h1 class="display-4">Feedback</h1>
      <p class="lead">We would love to hear from you!</p>

      <!-- feedback form -->
      <form id="feedback-form">
        <div class="row">
          <div class="form-group col-md-6 col-sm-12">
            <input type="text" id="name" name="name" class="form-control" placeholder="Name">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <textarea id="comment" name="comment" cols="30" rows="10" class="form-control" placeholder="Leave your comment here"></textarea>
        </div>
        <button class="fdbck-btn btn btn-primary">Submit</button>
      </form>

      <div id="feedback-success">
        <h1>Thank you for your feedback</h1>
        <p><i class="fas fa-check-circle fa-3x"></i></p>
      </div>

    </div>
  </section>

  <section class="advert">
    <div class="jumbotron">
      <h2>It's your</h2>
      <h1 class="display-4">Last Chance!</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur dolorem nesciunt voluptates! Aliquam blanditiis iure minus placeat repellat totam vel.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
  </section>

</div> <!-- .wrapper close -->

<script src="js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
<script src="js/bootstrap.min.js"></script> <!-- bootstrap -->
<script src="js/front.js"></script>
<script src="js/feedback.js"></script>
</body>
</html>