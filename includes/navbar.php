<?php
session_start();
?>

<link rel="stylesheet" href="style/css/navbar.css">
<script src="js/navbar.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="http://localhost/Assignment/php-products/" title="Furniture Home">
      <!--<i class="fas fa-chair fa-2x"></i>-->
      <img src="img/furniture-logo.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="categories.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
      </ul>

      <!-- search bar -->
      <form class="form-inline my-2 my-lg-0" style="position: relative">
        <input class="form-control mr-sm-2" id="search" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
        <div class="search-result">Type Something to search for...</div>
      </form>

      <div class="dropdown">
        <div class="dropdown-toggle" id="userMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if (isset($_SESSION['user'])): ?>
            <i class="fas fa-user"></i> <span class="user"><?= $_SESSION['user']['first_name'] ?></span>
          <?php else: ?>
            <i class="fas fa-user"></i>
          <?php endif; ?>
        </div>

        <!-- check if user logged in -->
        <?php if (!isset($_SESSION['user'])): ?>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenuButton">
            <a class="dropdown-item" id="login_btn" href="#">Login</a>
            <a class="dropdown-item" id="register_btn" href="#">Signup</a>
          </div>
        <?php else: ?>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenuButton">
            <a class="dropdown-item" id="account_btn" href="#">My Account</a>
            <a class="dropdown-item" id="cart_btn" href="#">View Cart</a>
            <a class="dropdown-item" id="cart_btn" href="logout.php">Logout</a>
          </div>
        <?php endif; ?>

      </div> <!-- .dropdown end -->
    </div> <!-- .navbar-collapse end -->
  </div> <!-- .container end -->
</nav>

<!-- Register Modal -->
<div class="register"></div>
<!-- Register Modal End -->

<!-- Login Modal -->
<div class="login"></div>