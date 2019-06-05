<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="http://localhost/Assignment/php-products/" title="Furniture Home">
      <i class="fas fa-chair fa-2x"></i></a>
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

      <div class="dropdown">
        <button class="btn dropdown-toggle" id="userMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </button>

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
<!-- Login Modal End -->

<script>
  $(document).ready(function() {
    //load the modal page and show when clicked
    $('#register_btn').click(function() {
      $('.register').load('./includes/register_modal.php', function () {  
        $('#registerModal').modal('show');
      });
    });

    $('#login_btn').click(function() {
      $('.login').load('./includes/login_modal.php', function () {  
        $('#loginModal').modal('show');
      });
    });
  });
</script>