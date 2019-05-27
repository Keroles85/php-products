<?php
require_once 'config.php';

function getProducts() {
  global $db, $products;
  $products = $db -> query("select prds.id, prds.name as product_name, prds.description, prds.price, 
    cat.name as cat_name, img.image_url from 
    products as prds inner join categories as cat on prds.id = cat.id
    inner join images as img on prds.id = img.product_id ");
}

getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Products Home Page</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../css/main.css"> <!-- my-style -->
</head>
<body>

  <div class="container-fluid">
    <div id="nav-section"></div>

    <section class="main-section">
      <div class="container">

        <h1>Admin Home Page</h1>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Category</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Image</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($products as $product): ?>
            <tr>
              <th scope="row"><?= $product['id'] ?></th>
              <td><?= $product['cat_name'] ?></td>
              <td><?= $product['product_name'] ?></td>
              <td><?= $product['description'] ?></td>
              <td><?= $product['price'] ?></td>
              <td><img src="<?= $product['image_url'] ?>" class="img-thumbnail"></td>
              <td>
                <a href="update.php?type=product&id=<?= $product['id'] ?>" title="Update Record">
                  <i class="fas fa-pen"></i>
                </a> &nbsp; 
                <a onClick="javascript: return confirm('Are you sure?!');" href="delete.php?type=product&id=<?= $product['id'] ?>" title="Delete Record">
                  <i class="fas fa-trash-alt" style="color:red"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>

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