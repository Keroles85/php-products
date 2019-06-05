<?php
session_start();

//check if user is logged in and if user is admin
if(!isset($_SESSION['admin'])) {
  header('location: login.php');
}

function dbConnect() {
  require 'config.php';
  return $db;
}

//get all carousel items
function getCarousel() {
  $db = dbConnect();
  $sql = 'SELECT * FROM carousel';
  $items = $db -> query($sql);
  unset($db);
  return $items;
}

function checkActive() {
  $db = dbConnect();
  $sql = 'SELECT * FROM carousel WHERE active=1';
  $stmt = $db -> query($sql);
  $active = $stmt -> rowCount();
  return $active;
}

//update carousel status (visibilty, active)
function updateStatus() {
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../style/css/main.css"> <!-- my-style -->
  <link rel="stylesheet" href="../style/css/carousel.css"> <!-- my-style -->
  <title>Carousel management page</title>
</head>
<body>
  <!-- Check for active items -->
  <?php if(!checkActive()):  ?>
    <script>
     window.addEventListener('load', function() {
        alert("There's no active items, must choose active item");
      });
    </script>
  <?php endif; ?>

  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">
        <h1>Carousel control page</h1>

        <a href='add.php?type=carousel' class="btn btn-success" style="margin: 0 0 2em 1em;">Add New Item</a>
        <button class="btn btn-primary" style="margin: 0 0 2em;">Update Status</button>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Caption</th>
              <th scope="col">Image URL</th>
              <th scope="col">Visible</th>
              <th scope="col">Active</th>
              <th scope="col" colspan="2" style="padding-left: 25px">Action</th>
            </tr>
          </thead>
          <tbody>

          <?php 
            $items = getCarousel();
            foreach($items as $item): 
          ?>

          <tr>
            <th scope="row">
              <?= $item['title'] ?>
            </th>
            <td>
              <?= $item['caption'] ?>
            </td>
            <td><img src="../<?= $item['img_url'] ?>" class="img-thumbnail"></td>
            <td>
              <input type="checkbox" name="visibilty" <?= $item['visible']? 'checked' : ''; ?>>
            </td>
            <td>
              <input type="radio" name="active" <?= $item['active']? 'checked' : ''; ?>>
              </td>
            <td>
              <a href="update.php?type=carousel&id=<?= $item['id'] ?>" title="Update Record">
                <i class="fas fa-pen"></i>
              </a>
            </td>
            <td>
              <a onClick="javascript: return confirm('Are you sure?!');" href="delete.php?type=carousel&id=<?= $product['id'] ?>" title="Delete Record">
                <i class="fas fa-trash-alt" style="color:red"></i>
              </a>
            </td>
          </tr>

          <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </section>
  </div>
  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>