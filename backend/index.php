<?php

session_start();

// include config file
function dbConnect(){
  require 'config.php';
  return $db;
}

//check if user is logged in and if user is admin
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
}

//get latest added product
function getLatest() {
  $db = dbConnect();
  $sql = 'SELECT products.*, images.image_url FROM products INNER JOIN images
    ON images.product_id = products.id ORDER BY id DESC LIMIT 1';
  $product = $db -> query($sql);
  unset($db);
  return $product;
}

//get inventory grouped by category
function getInventory() {
  $db = dbConnect();
  $sql = 'SELECT COUNT(products.id) AS inventory, categories.name AS category FROM 
    products INNER JOIN categories ON categories.id = products.cat_id
    GROUP BY products.cat_id';
  $stmt = $db -> query($sql);
  $inventory = $stmt -> fetchAll();
  unset($db);
  return $inventory;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Products Home Page</title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../style/css/main.css"> <!-- my-style -->
</head>

<body>

  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">

    <!-- LATEST ADDED PRODUCT -->
    <div class="card" style="margin: 2rem 0">
      <h5 class="card-header">
        Latest added item
      </h5>

      <?php
        $product = getLatest();
        foreach ($product as $cols):
      ?>

      <div class="row">
        <div class="col-4">
          <a href="#">
            <img src="../<?= $cols['image_url'] ?>" class="img-fluid" alt="" style="margin: 1rem">
          </a>
        </div>
        <div class="col-8">
          <div class="card-body">
            <h5 class="card-title"><?= $cols['name'] ?></h5>
            <p class="card-text"><?= $cols['description'] ?></p>
            <p class="card-text"><?= $cols['price'] ?></p>
          </div>
        </div>
      </div>

      <?php endforeach; ?>
    </div>
    
    <!-- CARDS COLUMNS -->
    <div class="row">

      <div class="col-4">
        <!-- INVENTORY CARD -->
        <div class="card">
          <h5 class="card-header">Inventory</h5>
          <div class="card-body">
            <table class="table table-borderless">
              <thead style="border-top: none;">
                <tr>
                  <th scope="col">Category</th>
                  <th scope="col" style="text-align:center;">Inventory</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $inventory = getInventory();
                  foreach($inventory as $cols):
                ?>
                <tr>
                  <th scope="row"><?= $cols['category'] ?></th>
                  <td style="text-align:center;"><?= $cols['inventory'] ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Latest Members</h5>
            <p class="card-text">select member first_name + last_name, isadmin</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Latest orders</h5>
            <p class="card-text">select latest orders after creating shopping cart</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
    
    </section>
  </div>

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>

</html>